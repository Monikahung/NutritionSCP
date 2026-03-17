<?php

namespace App\Services;

class OpenFoodFactsService
{
    protected string $baseUrl = 'https://id.openfoodfacts.org';

    public function searchProducts(string $query = '', int $page = 1, int $pageSize = 24, string $grade = ''): array
    {
        $params = http_build_query(array_filter([
            'search_terms' => $query,
            'page'         => $page,
            'page_size'    => $pageSize,
            'json'         => 'true',
            'fields'       => 'code,product_name,brands,categories,image_url,image_front_url,nutrition_grades,nutriments,ingredients_text,serving_size,nutriscore_score,nutriscore_grade',
            'nutrition_grades' => $grade ?: null,
        ]));

        $url = $this->baseUrl . '/cgi/search.pl?' . $params;

        $data = $this->fetch($url);

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
        $url  = $this->baseUrl . '/api/v0/product/' . urlencode($code) . '.json';
        $data = $this->fetch($url);

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

    private function fetch(string $url): ?array
    {
        $ctx = stream_context_create([
            'http' => [
                'timeout'        => 15,
                'method'         => 'GET',
                'header'         => "User-Agent: NutriCare/1.0 (tugas kuliah)\r\n",
                'ignore_errors'  => true,
            ],
            'ssl' => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ],
        ]);

        $raw = @file_get_contents($url, false, $ctx);

        if ($raw === false) {
            return null;
        }

        return json_decode($raw, true);
    }
}
