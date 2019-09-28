<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

class PassportService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function requestGrantToken($input, $scope = '')
    {
        $response = $this->client->post('http://127.0.0.1:8001/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('settings.client_id'),
                'client_secret' => config('settings.client_secret'),
                'username' => $input['email'],
                'password' => $input['password'],
                'scope' => $scope,
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    }

    public function getTokenByUser($user)
    {
        return $user->createToken('myToken')->accessToken;
    }
}
