<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait FireApiSync
{
    public function nothiSync($entity, $action, $data = [])
    {
        if (config('fire_api_sync.nothi_sync.able')) {
            $client = config('fire_api_sync.nothi_sync.api_client');
            $token = config('fire_api_sync.nothi_sync.token');
            $url = config('fire_api_sync.nothi_sync.office_doptor_sync_url');

            $payload = [[
                'action_type' => (string)$action,
                'data' => [$data],
            ]];
            $payload = json_encode($payload);

            $sendRequest = Http::withHeaders([
                'api_client' => $client,
                'token' => $token,
            ])->post($url, [
                'api_client' => $client,
                'token' => $token,
                'entity' => $entity,
                'payload' => $payload,
            ]);

            if ($sendRequest->status() == 200 && $sendRequest->json()['status'] == 'success') {
                return $sendRequest->json()['message'];
            } else {
                Log::log(1, json_encode($sendRequest->json()));
                return $sendRequest->json()['error_data'];
            }
        } else {
            return true;
        }
    }

    public function profilePictureSync($username, $profile_pic_base64)
    {
        $url = config('fire_api_sync.doptor_api_sync.upload_profile_picture');

        $sendRequest = $this->initHttpWithClientToken($username)->post($url, [
            'username' => $username,
            'profile_picture_base64' => $profile_pic_base64,
        ]);

        if ($sendRequest->status() != 200 || $sendRequest->json()['status'] != 'success') {
            Log::log(1, json_encode($sendRequest->json()));
        }
        return $sendRequest->json()['data'];
    }
}

