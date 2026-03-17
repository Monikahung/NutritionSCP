<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenFoodFactsService
{
    protected string $baseUrl = 'https://world.openfoodfacts.org';

    public function searchProducts(string $query = '', int $page = 1, int $pageSize = 24, string $grade = ''): array
    {
        $params = array_filter([
            'search_terms'     => $query,
            'page'             => $page,
            'page_size'        => $pageSize,
            'json'             => 'true',
            'fields'           => 'code,product_name,brands,categories,image_url,image_front_url,nutrition_grades,nutriments,ingredients_text,serving_size,nutriscore_score,nutriscore_grade',
            'nutrition_grades' => $grade ?: null,
        ]);

        $response = Http::withHeaders([
            'User-Agent' => 'NutriCare/1.0 (tugas kuliah)',
        ])->timeout(15)->get($this->baseUrl . '/cgi/search.pl', $params);

        if (!$response->successful()) {
            return ['products' => [], 'totalPages' => 0];
        }

        $data = $response->json();

        if (!$data || !isset($data['products'])) {
            return ['products' => [], 'totalPages' => 0];
        }

        $products = array_values(array_filter(
            array_map([$this, 'mapProduct'], $data['products']),
            fn($p) => $p !== null
        ));

        return [
            'products'   => $products,
            'totalPages' => max(1, (int) ($data['page_count'] ?? 1)),
        ];
    }

    public function getProduct(string $code): ?array
    {
        $response = Http::withHeaders([
            'User-Agent' => 'NutriCare/1.0 (tugas kuliah)',
        ])->timeout(15)->get($this->baseUrl . '/api/v0/product/' . urlencode($code) . '.json');

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();

        if (!$data || ($data['status'] ?? 0) !== 1 || empty($data['product'])) {
            return null;
        }

        return $this->mapProduct($data['product']);
    }

    private function mapProduct(array $p): ?array
    {
        $name  = trim($p['product_name'] ?? '');
        $grade = strtolower(trim($p['nutrition_grades'] ?? ''));
        $image = $p['image_url'] ?? $p['image_front_url'] ?? '';

        if (!$name || !$grade || !in_array($grade, ['a','b','c','d','e'], true)) {
            return null;
        }

        return [
            'id'              => $p['code'] ?? '',
            'code'            => $p['code'] ?? '',
            'product_name'    => $name,
            'brands'          => trim($p['brands'] ?? ''),
            'categories'      => $p['categories'] ?? '',
            'image_url'       => $image,
            'nutrition_grades'=> $grade,
            'nutriments'      => $p['nutriments'] ?? [],
            'ingredients_text'=> $p['ingredients_text'] ?? '',
            'serving_size'    => $p['serving_size'] ?? null,
            'nutriscore_score'=> $p['nutriscore_score'] ?? null,
            'nutriscore_grade'=> $p['nutriscore_grade'] ?? $grade,
        ];
    }
}
