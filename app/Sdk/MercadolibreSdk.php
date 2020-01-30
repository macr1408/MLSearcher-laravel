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
                $msg = $e->getResponse()->getBody(true);
                Log::error('ML SDK - No se pudo buscar productos: ' . $msg);
                if (strpos($msg, 'The requested offset is higher than the allowed.') !== false) {
                    return ['error' => 'Por favor agregá el access token en la configuración de tu cuenta para continuar buscando'];
                }
                return [];
            }
        }
    }
}
