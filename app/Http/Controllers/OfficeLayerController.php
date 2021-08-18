<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeLayer\StoreOfficeLayerRequest;
use App\Http\Requests\OfficeLayer\UpdateOfficeLayerRequest;
use App\Services\OfficeLayerService;
use Illuminate\Http\Request;

class OfficeLayerController extends Controller
{
    //for store & update
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

    //for update
    public function update(UpdateOfficeLayerRequest $request, OfficeLayerService $officeLayerService): \Illuminate\Http\JsonResponse
    {
        $storeOfficeLayer = $officeLayerService->update($request);
        if (isSuccessResponse($storeOfficeLayer)) {
            $response = responseFormat('success', $storeOfficeLayer['data']);
        } else {
            $response = responseFormat('error', $storeOfficeLayer['data']);
        }
        return response()->json($response);
    }

    //for show
    public function show(Request $request,OfficeLayerService $officeLayerService): \Illuminate\Http\JsonResponse
    {
        $officeLayerInfo = $officeLayerService->show($request->id);
        if (isSuccessResponse($officeLayerInfo)) {
            $response = responseFormat('success', $officeLayerInfo['data']);
        } else {
            $response = responseFormat('error', $officeLayerInfo['data']);
        }
        return response()->json($response);
    }

    //for get office Layer ministry wise
    public function getOfficeLayerMinistryWise(Request $request,OfficeLayerService $officeLayerService): \Illuminate\Http\JsonResponse
    {
        $officeLayers= $officeLayerService->getOfficeLayerMinistryWise($request->ministry_id);
        if (isSuccessResponse($officeLayers)) {
            $response = responseFormat('success', $officeLayers['data']);
        } else {
            $response = responseFormat('error', $officeLayers['data']);
        }
        return response()->json($response);
    }

    //for get office Layer tree ministry wise
    public function getOfficeLayerTreeMinistryWise(Request $request,OfficeLayerService $officeLayerService): \Illuminate\Http\JsonResponse
    {
        $officeLayers= $officeLayerService->getOfficeLayerTreeMinistryWise($request->ministry_id);
        if (isSuccessResponse($officeLayers)) {
            $response = responseFormat('success', $officeLayers['data']);
        } else {
            $response = responseFormat('error', $officeLayers['data']);
        }
        return response()->json($response);
    }
}
