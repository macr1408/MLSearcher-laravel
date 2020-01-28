<?php

namespace App\Sdk;

use App\Api\MercadolibreApi;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class MercadolibreSdk
{
    private $api;

    public function __construct(MercadolibreApi $api)
    {
        $this->api = $api;
    }

    public function search_products(string $term, array $filters): array
    {
        $params = ['q' => $term];
        $params = array_merge($params, $filters);
        $query = http_build_query($params);
        try {
            $results = $this->api->get('/search?' . $query);
            return $results;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                Log::error('No se pudo buscar productos: ' . $e->getResponse());
                return [];
            }
        }
    }
}
