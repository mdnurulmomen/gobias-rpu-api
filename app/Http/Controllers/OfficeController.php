<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeRequest;
use App\Services\OfficeServices;

class OfficeController extends Controller
{
    public function storeOffice(StoreOfficeRequest $request, OfficeServices $officeServices): \Illuminate\Http\JsonResponse
    {
        $store_office = $officeServices->storeOffice($request);
        if (isSuccessResponse($store_office)) {
            $response = responseFormat('success', $store_office['data']);
        } else {
            $response = responseFormat('error', $store_office['data']);
        }
        return response()->json($response);
    }
}
