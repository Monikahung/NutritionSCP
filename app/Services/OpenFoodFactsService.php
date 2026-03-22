<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class OpenFoodFactsService
{
    protected string $baseUrl = 'https://id.openfoodfacts.org';
    protected int $cacheTime = 600;

    public function searchProducts(string $query = '', int $page = 1, int $pageSize = 24, string $grade = ''): array
    {
        $cacheKey = "off_search_" . md5($query . $page . $pageSize . $grade);

        return Cache::remember($cacheKey, $this->cacheTime, function () use ($query, $page, $pageSize, $grade) {

            // Ambil data lebih banyak supaya search lebih akurat
            $fetchSize = !empty($query) ? 800 : max(100, $pageSize);

            $params = [
                'search_simple' => 1,
                'action'        => 'process',
                'page'          => 1, // ambil batch pertama, lalu paginate sendiri
                'page_size'     => $fetchSize,
                'json'          => 1,
                'fields'        => 'code,product_name,brands,categories,image_url,image_front_url,image_small_url,nutrition_grades,nutriments,ingredients_text,serving_size,nutriscore_score,nutriscore_grade'
            ];

            $searchQuery = $query;

            $params['search_terms'] = $searchQuery;

            if (!empty($grade)) {
                $params['tagtype_0'] = 'nutrition_grades';
                $params['tag_contains_0'] = 'contains';
                $params['tag_0'] = strtolower($grade);
            }

            $allProducts = [];

            for ($i = 1; $i <= 8; $i++) {

                $params['page'] = $i;

                $response = Http::withHeaders([
                    'User-Agent' => config('app.name') . '/1.0'
                ])
                    ->timeout(20)
                    ->retry(1, 100)
                    ->get($this->baseUrl . '/cgi/search.pl', $params);

                if (!$response->successful()) continue;

                $data = $response->json();

                if (!isset($data['products']) || !is_array($data['products'])) continue;

                $allProducts = array_merge($allProducts, $data['products']);
            }

            if (empty($allProducts)) {
                return [
                    'products' => [],
                    'totalPages' => 1
                ];
            }

            $products = array_values(array_filter(
                array_map([$this, 'mapProduct'], $allProducts)
            ));
            // Filter query (DIPERBAIKI)
            if (!empty($query)) {

                $queryLower = strtolower(trim($query));
                $queryWords = array_filter(explode(' ', $queryLower));

                $products = array_filter($products, function ($p) use ($queryWords) {

                    $fields = [
                        $p['product_name'] ?? '',
                        $p['brands'] ?? '',
                        implode(' ', $p['categories'] ?? [])
                    ];

                    // gabung semua text
                    $text = strtolower(implode(' ', $fields));

                    // pecah jadi kata-kata
                    $words = array_filter(preg_split('/\s+/', $text));

                    foreach ($queryWords as $qWord) {

                        // 🔥 RULE 1: substring match (CORE FIX)
                        foreach ($words as $word) {
                            if (str_contains($word, $qWord)) {
                                return true;
                            }
                        }

                        // 🔥 RULE 2: typo tolerance (indomi vs indomie)
                        foreach ($words as $word) {
                            if (levenshtein($qWord, $word) <= 2) {
                                return true;
                            }
                        }
                    }

                    return false;
                });

                $products = array_values($products);
            }

            // Filter grade kalau masih perlu aman di Laravel
            if (!empty($grade)) {
                $products = array_values(array_filter($products, function ($p) use ($grade) {
                    return isset($p['nutrition_grades']) &&
                        strtolower($p['nutrition_grades']) === strtolower($grade);
                }));
            }

            // 🔥 SORT HANYA SAAT ADA SEARCH / FILTER
            if (!empty($query) || !empty($grade)) {

                usort($products, function ($a, $b) {

                    $priority = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];

                    $gradeA = $priority[$a['nutrition_grades']] ?? 99;
                    $gradeB = $priority[$b['nutrition_grades']] ?? 99;

                    if ($gradeA !== $gradeB) {
                        return $gradeA <=> $gradeB;
                    }

                    if (!empty($a['image_url']) && empty($b['image_url'])) return -1;
                    if (empty($a['image_url']) && !empty($b['image_url'])) return 1;

                    return 0;
                });
            }

            $totalProducts = count($products);

            // 🔥 FIX 1: kalau data sedikit → paksa 1 page
            if ($totalProducts <= $pageSize) {
                return [
                    'products' => array_slice($products, 0, $pageSize),
                    'totalPages' => 1
                ];
            }

            $totalPages = (int) ceil($totalProducts / $pageSize);

            // 🔥 FIX 2: clamp page
            $page = max(1, min($page, $totalPages));

            $offset = ($page - 1) * $pageSize;

            // 🔥 FIX 3: kalau offset udah keluar dari data → reset
            if ($offset >= $totalProducts) {
                $page = 1;
                $offset = 0;
            }

            $pagedProducts = array_slice($products, $offset, $pageSize);

            return [
                'products' => $pagedProducts,
                'totalPages' => $totalPages
            ];
        });
    }


    public function getProduct(string $code): ?array
    {
        $code = preg_replace('/[^0-9]/', '', $code);

        if (!$code) {
            return null;
        }

        $cacheKey = "off_product_" . $code;

        return Cache::remember($cacheKey, $this->cacheTime, function () use ($code) {

            $response = Http::withHeaders([
                'User-Agent' => config('app.name') . '/1.0'
            ])
                ->timeout(20)
                ->retry(2, 200)
                ->get($this->baseUrl . '/api/v0/product/' . $code . '.json');

            if (!$response->successful()) {
                return null;
            }

            $data = $response->json();

            if (($data['status'] ?? 0) !== 1 || empty($data['product'])) {
                return null;
            }

            return $this->mapProduct($data['product']);
        });
    }


    private function mapProduct(array $p): ?array
    {
        $name = trim($p['product_name'] ?? '') ?: 'Produk Tanpa Nama';

        if (!$name) {
            return null;
        }

        $grade = strtolower(trim($p['nutrition_grades'] ?? 'unknown'));

        $image =
            $p['image_front_url']
            ?? $p['image_url']
            ?? $p['image_small_url']
            ?? null;

        $nutriments = $p['nutriments'] ?? [];

        return [
            'id'   => $p['code'] ?? '',
            'code' => $p['code'] ?? '',

            'product_name' => $name,
            'brands' => trim($p['brands'] ?? ''),

            'categories' => isset($p['categories'])
                ? explode(',', $p['categories'])
                : [],

            'image_url' => $image,

            'nutrition_grades' => $grade,

            'nutriscore_score' => $p['nutriscore_score'] ?? null,
            'nutriscore_grade' => $p['nutriscore_grade'] ?? $grade,

            'ingredients_text' => $p['ingredients_text'] ?? '',
            'serving_size'     => $p['serving_size'] ?? null,

            // nutrisi utama
            'nutrition' => [
                'energy' => $nutriments['energy-kcal_100g'] ?? null,
                'fat' => $nutriments['fat_100g'] ?? null,
                'saturated-fat' => $nutriments['saturated-fat_100g'] ?? null,
                'carbohydrates' => $nutriments['carbohydrates_100g'] ?? null,
                'sugars' => $nutriments['sugars_100g'] ?? null,
                'fiber' => $nutriments['fiber_100g'] ?? null,
                'proteins' => $nutriments['proteins_100g'] ?? null,
                'salt' => $nutriments['salt_100g'] ?? null,
                'sodium' => $nutriments['sodium_100g'] ?? null,
                'fruits' => $nutriments['fruits-vegetables-nuts_100g'] ?? null
            ],

            // data asli api
            'nutriments' => $nutriments
        ];
    }
}
