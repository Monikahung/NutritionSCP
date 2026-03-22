<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OpenFoodFactsService;
use Illuminate\Support\Facades\Log;

class NutritionProductController extends Controller
{
    public function __construct(protected OpenFoodFactsService $api) {}

    public function index(Request $request)
    {
        $query = $request->input('q', '');
        $grade = $request->input('grade', '');
        $page  = max(1, (int) $request->input('page', 1));

        $result = [
            'products' => [],
            'totalPages' => 1,
            'error' => null
        ];

        try {

            $data = $this->api->searchProducts($query, $page, 24, $grade);

            $result['products']   = $data['products'];
            $result['totalPages'] = $data['totalPages'];
        } catch (\Throwable $e) {

            Log::error($e);

            $result['error'] = 'Gagal memuat produk dari API. Silakan coba lagi.';
        }

        return view('admin.products.index', [
            'products' => $result['products'],
            'totalPages' => $result['totalPages'],
            'query' => $query,
            'grade' => $grade,
            'page' => $page,
            'error' => $result['error'],
        ]);
    }


    public function show(string $code)
    {
        try {

            $product = $this->api->getProduct($code);

            if (!$product) {
                abort(404, 'Produk tidak ditemukan.');
            }

            return view('admin.products.nutritionshow', compact('product'));
        } catch (\Throwable $e) {

            Log::error($e);

            return view('admin.products.nutritionshow', [
                'product' => [
                    'product_name' => 'Produk tidak ditemukan',
                    'nutriments' => []
                ],
                'error' => 'Gagal memuat detail produk dari API.'
            ]);
        }
    }

    public function api(Request $request)
    {
        $query = $request->input('q', '');
        $grade = $request->input('grade', '');
        $page  = max(1, (int)$request->input('page', 1));

        try {
            $data = $this->api->searchProducts($query, $page, 24, $grade);

            return response()->json($data);
        } catch (\Throwable $e) {

            return response()->json([
                'products' => [],
                'totalPages' => 1,
                'error' => $e->getMessage()
            ]);
        }
    }
}
