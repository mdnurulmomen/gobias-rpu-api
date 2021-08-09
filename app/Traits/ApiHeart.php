<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ApiHeart
{
    public function initHttpWithClientToken($username): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->apiHeaders())->withToken($this->getClientToken($username));
    }

    public function apiHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'api-version' => '1'
        ];
    }

    public function getClientToken($username): string
    {
        $url = config('fire_api_sync.doptor_api_sync.client_login_url');
        $client_id = config('fire_api_sync.doptor_api_sync.client_id');
        $client_pass = config('fire_api_sync.doptor_api_sync.client_pass');

        $getToken = $this->initHttp()->post($url, [
            'client_id' => $client_id,
            'password' => $client_pass,
            'username' => $username,
        ]);

        if ($getToken->status() == 200 && $getToken->json()['status'] == 'success') {
            return $getToken->json()['data']['token'];
        } else {
            return '';
        }
    }

    public function initHttp(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->apiHeaders());
    }
}

