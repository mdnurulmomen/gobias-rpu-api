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

    public function update(UpdateOfficeRequest $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
       //
    }

    public function show(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        //
    }

}