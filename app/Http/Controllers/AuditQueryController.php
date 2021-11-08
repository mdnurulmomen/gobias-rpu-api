<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\AuditQueryService;

class AuditQueryController extends Controller
{
    public function store(Request $request, AuditQueryService $auditQueryService): \Illuminate\Http\JsonResponse
    {
        $storeAuditQuery = $auditQueryService->store($request);
//        dd($storeAuditQuery);
        if (isSuccessResponse($storeAuditQuery)) {
            $response = responseFormat('success', $storeAuditQuery['data']);
        } else {
            $response = responseFormat('error', $storeAuditQuery['data']);
        }
        return response()->json($response);
    }

    public function receiveQuery(Request $request, AuditQueryService $auditQueryService): \Illuminate\Http\JsonResponse
    {
        $removeQuery = $auditQueryService->receiveQuery($request);
        if (isSuccessResponse($removeQuery)) {
            $response = responseFormat('success', $removeQuery['data']);
        } else {
            $response = responseFormat('error', $removeQuery['data']);
        }
        return response()->json($response);

    }

    public function removeQuery(Request $request, AuditQueryService $auditQueryService): \Illuminate\Http\JsonResponse
    {
        $removeQuery = $auditQueryService->removeQuery($request);
        if (isSuccessResponse($removeQuery)) {
            $response = responseFormat('success', $removeQuery['data']);
        } else {
            $response = responseFormat('error', $removeQuery['data']);
        }
        return response()->json($response);

    }



}
