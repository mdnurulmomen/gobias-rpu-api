<?php

namespace App\Http\Controllers;

use App\Services\BatchService;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function list(Request $request, BatchService $batchService): \Illuminate\Http\JsonResponse
    {
        $batchList = $batchService->list($request);
        if (isSuccessResponse($batchList)) {
            $response = responseFormat('success', $batchList['data']);
        } else {
            $response = responseFormat('error', $batchList['data']);
        }
        return response()->json($response);
    }
}
