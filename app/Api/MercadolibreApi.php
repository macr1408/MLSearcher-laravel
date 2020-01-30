<?php

namespace App\Api;

class MercadolibreApi
{

    const BASE_URL = 'https://api.mercadolibre.com/sites/MLA';
    const AUTH_URL = 'https://api.mercadolibre.com/oauth/token';
    private $client;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function auth(array $params): array
    {
        $request = $this->client->post(self::AUTH_URL . '?' . http_build_query($params));
        $response = $request->getBody();
        return json_decode($response, true);
    }

    public function refreshToken(array $params): array
    {
        $request = $this->client->post(self::AUTH_URL . '?' . http_build_query($params));
        $response = $request->getBody();
        return json_decode($response, true);
    }

    public function get(string $endpoint): array
    {
        $request = $this->client->get(self::BASE_URL . $endpoint);
        $response = $request->getBody();
        return json_decode($response, true);
    }
}
