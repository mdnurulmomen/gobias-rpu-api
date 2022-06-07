<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\ApottiService;

class ApottiController extends Controller
{
    public function getApottiItem(Request $request, ApottiService $apottiService): \Illuminate\Http\JsonResponse
    {
        $apottiItemList = $apottiService->getApottiItem($request);
        if (isSuccessResponse($apottiItemList)) {
            $response = responseFormat('success', $apottiItemList['data']);
        } else {
            $response = responseFormat('error', $apottiItemList['data']);
        }
        return response()->json($response);
    }

    public function getMinistryWiseApottiEntity(Request $request, ApottiService $apottiService): \Illuminate\Http\JsonResponse
    {
        $apottiItemList = $apottiService->getMinistryWiseApottiEntity($request);
        if (isSuccessResponse($apottiItemList)) {
            $response = responseFormat('success', $apottiItemList['data']);
        } else {
            $response = responseFormat('error', $apottiItemList['data']);
        }
        return response()->json($response);
    }

    public function apottiResponseSubmit(Request $request, ApottiService $apottiService): \Illuminate\Http\JsonResponse
    {
        $apottiItemList = $apottiService->apottiResponseSubmit($request);
        if (isSuccessResponse($apottiItemList)) {
            $response = responseFormat('success', $apottiItemList['data']);
        } else {
            $response = responseFormat('error', $apottiItemList['data']);
        }
        return response()->json($response);
    }

    public function storeRpuBroadSheet(Request $request, ApottiService $apottiService): \Illuminate\Http\JsonResponse
    {
        $apottiItemList = $apottiService->storeRpuBroadSheet($request);
        if (isSuccessResponse($apottiItemList)) {
            $response = responseFormat('success', $apottiItemList['data']);
        } else {
            $response = responseFormat('error', $apottiItemList['data']);
        }
        return response()->json($response);
    }

}
