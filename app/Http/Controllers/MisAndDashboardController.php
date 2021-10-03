<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\MisAndDashboardService;

class MisAndDashboardController extends Controller
{
    public function rpuList(Request $request,MisAndDashboardService $misAndDashboardService): \Illuminate\Http\JsonResponse
    {
        $rpuList = $misAndDashboardService->rpuList($request);
        if (isSuccessResponse($rpuList)) {
            $response = responseFormat('success', $rpuList['data']);
        } else {
            $response = responseFormat('error', $rpuList['data']);
        }
        return response()->json($response);
    }
}
