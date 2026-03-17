<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OpenFoodFactsService;

class NutritionProductController extends Controller
{
    public function __construct(protected OpenFoodFactsService $api) {}

    public function index(Request $request)
    {
        $query = $request->input('q', '');
        $grade = $request->input('grade', '');
        $page  = max(1, (int) $request->input('page', 1));

        $result = ['products' => [], 'totalPages' => 1, 'error' => null];

        try {
            $data = $this->api->searchProducts($query, $page, 24, $grade);
            $result['products']   = $data['products'];
            $result['totalPages'] = $data['totalPages'];
        } catch (\Throwable $e) {
            $result['error'] = 'Gagal memuat produk dari API. Silakan coba lagi.';
        }

        return view('admin.products.index', [
            'products'   => $result['products'],
            'totalPages' => $result['totalPages'],
            'error'      => $result['error'],
            'query'      => $query,
            'grade'      => $grade,
            'page'       => $page,
        ]);
    }

    public function show(string $code)
    {
        try {
            $product = $this->api->getProduct($code);

            if (!$product) {
                abort(404, 'Produk tidak ditemukan.');
            }

            return view('admin.products.show', compact('product'));
        } catch (\Throwable $e) {
            return view('admin.products.show', [
                'product' => ['product_name' => 'Produk tidak ditemukan', 'nutriments' => []],
                'error'   => 'Gagal memuat detail produk dari API.',
            ]);
        }
    }
}
