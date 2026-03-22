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

            $params = [
                'search_terms'  => $query,
                'search_simple' => 1,
                'action'        => 'process',
                'page'          => $page,
                'page_size' => 100,
                'json'          => 1,
                'fields'        => 'code,product_name,brands,categories,image_url,image_front_url,image_small_url,nutrition_grades,nutriments,ingredients_text,serving_size,nutriscore_score,nutriscore_grade'
            ];

            // ✅ SATU request saja
            $response = Http::timeout(30)->get($this->baseUrl . '/cgi/search.pl', $params);

            if (!$response->successful()) {
                return [
                    'products' => [],
                    'totalPages' => 1
                ];
            }

            $data = $response->json();

            if (!$data || !isset($data['products'])) {
                return [
                    'products' => [],
                    'totalPages' => 1
                ];
            }

            if (!isset($data['products'])) {
                return [
                    'products' => [],
                    'totalPages' => 1
                ];
            }

            // mapping
            $products = array_values(array_filter(
                array_map([$this, 'mapProduct'], $data['products'])
            ));

            // Jika ada query (dari search?), beri filter lebih ketat untuk brand/kategori/nama
            if (!empty($query)) {
                $searchLower = strtolower(trim($query));

                $products = array_values(array_filter($products, function ($p) use ($searchLower) {
                    if (!$p) {
                        return false;
                    }

                    $nameMatch = str_contains(strtolower($p['product_name'] ?? ''), $searchLower);
                    $brandMatch = str_contains(strtolower($p['brands'] ?? ''), $searchLower);

                    $categoryMatch = false;
                    if (!empty($p['categories']) && is_array($p['categories'])) {
                        foreach ($p['categories'] as $cat) {
                            if (str_contains(strtolower($cat), $searchLower)) {
                                $categoryMatch = true;
                                break;
                            }
                        }
                    }

                    return $nameMatch || $brandMatch || $categoryMatch;
                }));
            }

            // ✅ filter di Laravel (AMAN) berdasarkan grade
            if (!empty($grade)) {
                $products = array_values(array_filter($products, function ($p) use ($grade) {
                    return isset($p['nutrition_grades']) &&
                        strtolower($p['nutrition_grades']) === strtolower($grade);
                }));
            }

            return [
                'products' => $products,
                'totalPages' => max(1, (int)($data['page_count'] ?? 1))
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
