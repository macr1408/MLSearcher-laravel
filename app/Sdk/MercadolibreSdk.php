<?php

namespace App\Sdk;

use App\Api\MercadolibreApi;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class MercadolibreSdk
{
    private $api, $accessToken;

    public function __construct(MercadolibreApi $api)
    {
        $this->api = $api;
        $this->accessToken = '';
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function searchProducts(string $term, array $filters): array
    {
        $params = ['q' => $term, 'access_token' => $this->accessToken, 'sort' => 'price_asc'];
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
                    return ['error' => 'Por favor agregá el access token en la configuración de tu cuenta o segmenta tu búsqueda para continuar buscando'];
                }
                return [];
            }
        }
    }

    public function auth(string $code, string $redirectUri): array
    {
        $params = [
            'grant_type' => 'authorization_code',
            'client_id' => getenv('ML_CLIENT_ID'),
            'client_secret' => getenv('ML_CLIENT_SECRET'),
            'code' => $code,
            'redirect_uri' => $redirectUri
        ];
        return $this->api->auth($params);
    }

    public function refreshToken(string $refreshToken)
    {
        $params = [
            'grant_type' => 'refresh_token',
            'client_id' => getenv('ML_CLIENT_ID'),
            'client_secret' => getenv('ML_CLIENT_SECRET'),
            'refresh_token' => $refreshToken
        ];
        return $this->api->refreshToken($params);
    }
}
