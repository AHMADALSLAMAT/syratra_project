<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiAccess {
// API ACCESS TO THE AMADEUS
    public function access_token(Client $client)
    {
        $url = 'https://test.api.amadeus.com/v1/security/oauth2/token';
        try {
            $response = $client->post($url, [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => 'ZVF2CkfMeEy5JGhwSwiDceXwOCBeOo8o',
                    'client_secret' => 'fUJOmza8mvbWBHK0'
                ]
            ]);
            $response = $response->getBody();
            $access_token = json_decode($response)->access_token;
            return $access_token;
        } catch (GuzzleException $exception) {
            dd($exception);
        }
    }
}