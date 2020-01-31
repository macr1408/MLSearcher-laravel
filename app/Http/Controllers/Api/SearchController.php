<?php

namespace App\Http\Controllers\Api;

use App\Services\MercadolibreSearchService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{

    public function create(Request $request, MercadolibreSearchService $service): \Illuminate\Http\JsonResponse
    {
        if (!$request->isJson()) {
            return response()->json([
                'error' => 'Wrong content type. Format must be a valid JSON'
            ]);
        }
        $data = $request->json()->all();
        $rules = [
            'q' => 'required|string|min:3'
        ];
        $validator = Validator::make($data, $rules);
        $query = filter_var($data['q'], FILTER_SANITIZE_STRING);
        $filters = $data['filters'] ?? ['offset' => 0];
        $user = auth('api')->user();
        if (!$validator->fails()) {
            $products = $service->searchProducts($query, $filters, $user ?? new \stdClass);
            if (!empty($products['error'])) {
                return response()->json($products, 422);
            }
            return response()->json($products);
        } else {
            return response()->json(['error' => $validator->errors()->all()], 500);
        }
    }
}
