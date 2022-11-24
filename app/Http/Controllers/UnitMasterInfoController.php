<?php

namespace App\Http\Controllers;

use App\Services\UnitMasterInfoService;
use Illuminate\Http\Request;

class UnitMasterInfoController extends Controller
{
    public function list(Request $request, UnitMasterInfoService $unitMasterInfoService)
    {
        $list = $unitMasterInfoService->list($request);

        if (isSuccessResponse($list)) {
            $response = responseFormat('success', $list['data']);
        } else {
            $response = responseFormat('error', $list['data']);
        }

        return response()->json($response);
    }

    public function update(Request $request, UnitMasterInfoService $projectService): \Illuminate\Http\JsonResponse
    {
        $response = $projectService->update($request);

        if (isSuccessResponse($response)) {
            $response = responseFormat('success', $response['data']);
        } else {
            $response = responseFormat('error', $response['data']);
        }

        return response()->json($response);
    }
}
