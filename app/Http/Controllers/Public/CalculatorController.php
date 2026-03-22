<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OpenFoodFactsService;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('public.calculator');
    }

    public function calculate(Request $request, OpenFoodFactsService $service)
    {
        $products = $request->products ?? [];
        $product_names = $request->product_names ?? [];

        $results = [];

        foreach ($products as $code) {
            $product = $service->getProduct($code);

            if ($product) {
                $results[] = $product;
            }
        }

        return view('public.calculator', [
            'results' => $results,
            'products' => $products,
            'product_names' => $product_names
        ]);
    }

    public function search(Request $request, OpenFoodFactsService $service)
    {
        $query = $request->q;
        $data = $service->searchProducts($query);

        return response()->json($data['products']);
    }
}