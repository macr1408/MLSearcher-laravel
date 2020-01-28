<?php

namespace App\Http\Controllers\Api;

use App\Sdk\MercadolibreSdk;
use App\UserSettings;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{

    const PRODUCTS_LIMIT = 50;

    public function create(Request $request, MercadolibreSdk $mlsdk): \Illuminate\Http\JsonResponse
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
        if (!$validator->fails()) {
            $products = $mlsdk->search_products($query, $filters);
            $products = $this->maybe_filter_products($products);
            while (count($products['results']) < self::PRODUCTS_LIMIT) {
                $filters['offset'] = $products['paging']['offset'] + self::PRODUCTS_LIMIT;
                $nextProducts = $mlsdk->search_products($query, $filters);
                $nextProducts = $this->maybe_filter_products($nextProducts);
                $products['results'] = array_merge($products['results'], $nextProducts['results']);
                $products['paging']['offset'] = $nextProducts['paging']['offset'];
            }
            return response()->json($products);
        } else {
            return response()->json($validator->errors()->all(), 500);
        }
    }

    protected function maybe_filter_products(array $products): array
    {
        $user = auth('api')->user();
        if (empty($user)) {
            return $products;
        }
        try {
            $userSettings = UserSettings::where('user_id', '=', $user->id)->firstOrFail();
        } catch (\Exception $e) {
            return $products;
        }
        $userSettings = UserSettings::where('user_id', '=', $user->id)->firstOrFail();
        if (empty($userSettings['allowed-locations'])) {
            return $products;
        }
        return $this->filter_products($products, $userSettings['allowed-locations']);
    }

    protected function filter_products(array $products, string $allowedLocations): array
    {
        $locations = explode(',', $allowedLocations);
        $products['results'] = array_filter($products['results'], function ($elem) use ($locations) {
            $productLocation = strtolower($elem['address']['city_name']);
            $productLocation = str_ireplace('Á', 'a', $productLocation);
            $productLocation = str_ireplace('É', 'e', $productLocation);
            $productLocation = str_ireplace('Í', 'i', $productLocation);
            $productLocation = str_ireplace('Ó', 'o', $productLocation);
            $productLocation = str_ireplace('ú', 'u', $productLocation);
            $productLocation = trim($productLocation);
            if (in_array($productLocation, $locations)) {
                return true;
            }
            return false;
        });
        return $products;
    }
}
