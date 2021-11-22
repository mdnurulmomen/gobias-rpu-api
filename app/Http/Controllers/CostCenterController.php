<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\CostCenterService;

class CostCenterController extends Controller
{
    public function store(Request $request,CostCenterService $costCenterService): \Illuminate\Http\JsonResponse
    {
        $store = $costCenterService->store($request);
//        dd($store);
        if (isSuccessResponse($store)) {
            $response = responseFormat('success', $store['data']);
        } else {
            $response = responseFormat('error', $store['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateOfficeRequest $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $storeOffice = $officeServices->update($request);
        if (isSuccessResponse($storeOffice)) {
            $response = responseFormat('success', $storeOffice['data']);
        } else {
            $response = responseFormat('error', $storeOffice['data']);
        }
        return response()->json($response);
    }


    public function list(Request $request, CostCenterService $costCenterService): \Illuminate\Http\JsonResponse
    {
        $officeList = $costCenterService->list($request);
        if (isSuccessResponse($officeList)) {
            $response = responseFormat('success', $officeList['data']);
        } else {
            $response = responseFormat('error', $officeList['data']);
        }
        return response()->json($response);
    }

}
