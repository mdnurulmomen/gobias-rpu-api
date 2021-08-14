<?php

namespace App\Http\Controllers;

use App\Services\OfficeCustomLayerService;
use Illuminate\Http\Request;

class OfficeCustomLayerController extends Controller
{
    public function store(Request $request, OfficeCustomLayerService $OfficeCustomLayerService): \Illuminate\Http\JsonResponse
    {
        $storeOfficeLayer = $OfficeCustomLayerService->store($request);
        if (isSuccessResponse($storeOfficeLayer)) {
            $response = responseFormat('success', $storeOfficeLayer['data']);
        } else {
            $response = responseFormat('error', $storeOfficeLayer['data']);
        }
        return response()->json($response);
    }

    public function update(Request $request, OfficeCustomLayerService $OfficeCustomLayerService): \Illuminate\Http\JsonResponse
    {
        $storeOfficeLayer = $OfficeCustomLayerService->update($request);
        if (isSuccessResponse($storeOfficeLayer)) {
            $response = responseFormat('success', $storeOfficeLayer['data']);
        } else {
            $response = responseFormat('error', $storeOfficeLayer['data']);
        }
        return response()->json($response);
    }


    public function list(Request $request,OfficeCustomLayerService $OfficeCustomLayerService): \Illuminate\Http\JsonResponse
    {
        $officeLayers= $OfficeCustomLayerService->list($request);
        if (isSuccessResponse($officeLayers)) {
            $response = responseFormat('success', $officeLayers['data']);
        } else {
            $response = responseFormat('error', $officeLayers['data']);
        }
        return response()->json($response);
    }
}
