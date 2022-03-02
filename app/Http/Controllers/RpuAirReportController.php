<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\RpuAirReportService;

class RpuAirReportController extends Controller
{
    public function store(Request $request, RpuAirReportService $airReportService): \Illuminate\Http\JsonResponse
    {
        $storeAir = $airReportService->store($request);
        if (isSuccessResponse($storeAir)) {
            $response = responseFormat('success', $storeAir['data']);
        } else {
            $response = responseFormat('error', $storeAir['data']);
        }
        return response()->json($response);
    }

    public function updateApottiItem(Request $request, RpuAirReportService $airReportService): \Illuminate\Http\JsonResponse
    {
        $storeAir = $airReportService->updateApottiItem($request);
        if (isSuccessResponse($storeAir)) {
            $response = responseFormat('success', $storeAir['data']);
        } else {
            $response = responseFormat('error', $storeAir['data']);
        }
        return response()->json($response);
    }

    public function broadSheetReplyFromDirectorate(Request $request, RpuAirReportService $airReportService): \Illuminate\Http\JsonResponse
    {
        $storeAir = $airReportService->broadSheetReplyFromDirectorate($request);
        if (isSuccessResponse($storeAir)) {
            $response = responseFormat('success', $storeAir['data']);
        } else {
            $response = responseFormat('error', $storeAir['data']);
        }
        return response()->json($response);
    }


}
