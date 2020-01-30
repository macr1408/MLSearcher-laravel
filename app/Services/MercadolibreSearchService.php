<?php

namespace App\Services;

use App\Sdk\MercadolibreSdk;
use App\UserSettings;

class MercadolibreSearchService
{
    const PRODUCTS_LIMIT = 50;

    private $sdk;

    public function __construct(MercadolibreSdk $mlsdk)
    {
        $this->sdk = $mlsdk;
    }

    public function search_products(string $query, array $filters): array
    {
        $products = $this->sdk->search_products($query, $filters);
        if (empty($products['results'])) {
            return $products;
        }
        $products = $this->maybe_filter_products($products);
        while (count($products['results']) < self::PRODUCTS_LIMIT) {
            $filters['offset'] = $products['paging']['offset'] + self::PRODUCTS_LIMIT;
            $nextProducts = $this->sdk->search_products($query, $filters);
            if (empty($nextProducts['results'])) {
                break;
            }
            $nextProducts = $this->maybe_filter_products($nextProducts);
            $products['results'] = array_merge($products['results'], $nextProducts['results']);
            $products['paging']['offset'] = $nextProducts['paging']['offset'];
        }
        if (!empty($nextProducts['error'])) {
            return ['error' => $nextProducts['error'], 'products' => $products];
        }
        return $products;
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
