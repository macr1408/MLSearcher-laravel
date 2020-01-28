<?php

namespace App\Api;

class MercadolibreApi
{

    const BASE_URL = 'https://api.mercadolibre.com/sites/MLA';
    private $client;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function get(string $endpoint): array
    {
        $request = $this->client->get(self::BASE_URL . $endpoint);
        $response = $request->getBody();
        return json_decode($response, true);
    }
}
