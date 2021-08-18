<?php

namespace App\Http\Controllers;
use App\Services\GeoDivisionService;
use Illuminate\Http\Request;

class GeoDivisionController extends Controller
{
    public function list(Request $request, GeoDivisionService $geoDivisionService): \Illuminate\Http\JsonResponse
    {
        $geoDivisionList = $geoDivisionService->list($request);
        if (isSuccessResponse($geoDivisionList)) {
            $response = responseFormat('success', $geoDivisionList['data']);
        } else {
            $response = responseFormat('error', $geoDivisionList['data']);
        }
        return response()->json($response);
    }
}
