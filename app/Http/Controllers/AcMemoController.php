<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\AcMemoService;

class AcMemoController extends Controller
{
    public function store(Request $request, AcMemoService $acMemoService): \Illuminate\Http\JsonResponse
    {
        $storeAuditMemo = $acMemoService->store($request);
        if (isSuccessResponse($storeAuditMemo)) {
            $response = responseFormat('success', $storeAuditMemo['data']);
        } else {
            $response = responseFormat('error', $storeAuditMemo['data']);
        }
        return response()->json($response);
    }

    public function update(Request $request, AcMemoService $acMemoService): \Illuminate\Http\JsonResponse
    {
        $updateAuditMemo = $acMemoService->update($request);
        if (isSuccessResponse($updateAuditMemo)) {
            $response = responseFormat('success', $updateAuditMemo['data']);
        } else {
            $response = responseFormat('error', $updateAuditMemo['data']);
        }
        return response()->json($response);
    }

}
