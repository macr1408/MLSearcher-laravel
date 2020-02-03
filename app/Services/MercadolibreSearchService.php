<?php

namespace App\Services;

use App\Sdk\MercadolibreSdk;
use App\UserSettings;

class MercadolibreSearchService
{
    const PRODUCTS_LIMIT = 5;

    private $sdk, $mercadolibreTokenService;

    public function __construct(MercadolibreSdk $mlsdk, MercadolibreTokenService $mercadolibreTokenService)
    {
        $this->sdk = $mlsdk;
        $this->mercadolibreTokenService = $mercadolibreTokenService;
    }

    public function searchProducts(string $query, array $filters, object $user): array
    {
        $products = $this->sdk->searchProducts($query, $filters);
        if (empty($products['results'])) {
            return $products;
        }
        $products = $this->maybeFilterProducts($products, $user);
        while (count($products['results']) < self::PRODUCTS_LIMIT) {
            $filters['offset'] = $products['paging']['offset'] + 50;
            $nextProducts = $this->sdk->searchProducts($query, $filters);
            if (empty($nextProducts['results'])) {
                break;
            }
            $nextProducts = $this->maybeFilterProducts($nextProducts, $user);
            $products['results'] = array_merge($products['results'], $nextProducts['results']);
            $products['paging']['offset'] = $nextProducts['paging']['offset'];
        }
        if (!empty($nextProducts['error'])) {
            return ['error' => $nextProducts['error'], 'products' => $products];
        }
        return $products;
    }

    protected function maybeFilterProducts(array $products, object $user): array
    {
        if (empty($user)) {
            return $products;
        }
        try {
            $userSettings = UserSettings::where('user_id', '=', $user->id)->firstOrFail();
            $this->mercadolibreTokenService->maybe_update_access_token($user->id);
            if (!empty($userSettings->ml_access_token)) {
                $this->sdk->setAccessToken($userSettings->ml_access_token);
            }
        } catch (\Exception $e) {
            return $products;
        }
        if (empty($userSettings['allowed-locations'])) {
            return $products;
        }
        return $this->filterProducts($products, $userSettings['allowed-locations']);
    }

    protected function filterProducts(array $products, string $allowedLocations): array
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
