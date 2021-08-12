<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeLayerRequest;
use App\Services\OfficeLayerService;
use Illuminate\Http\Request;

class OfficeLayerController extends Controller
{
    public function store(StoreOfficeLayerRequest $request, OfficeLayerService $officeLayerService): \Illuminate\Http\JsonResponse
    {
        $storeOfficeLayer = $officeLayerService->store($request);
        if (isSuccessResponse($storeOfficeLayer)) {
            $response = responseFormat('success', $storeOfficeLayer['data']);
        } else {
            $response = responseFormat('error', $storeOfficeLayer['data']);
        }
        return response()->json($response);
    }

    public function update(StoreOfficeLayerRequest $request, OfficeLayerService $officeLayerService): \Illuminate\Http\JsonResponse
    {
        $storeOfficeLayer = $officeLayerService->update($request);
        if (isSuccessResponse($storeOfficeLayer)) {
            $response = responseFormat('success', $storeOfficeLayer['data']);
        } else {
            $response = responseFormat('error', $storeOfficeLayer['data']);
        }
        return response()->json($response);
    }

    public function show(Request $request,OfficeLayerService $officeLayerService): \Illuminate\Http\JsonResponse
    {
        $officeLayerInfo = $officeLayerService->show($request->office_layer_id);
        if (isSuccessResponse($officeLayerInfo)) {
            $response = responseFormat('success', $officeLayerInfo['data']);
        } else {
            $response = responseFormat('error', $officeLayerInfo['data']);
        }
        return response()->json($response);
    }

}
