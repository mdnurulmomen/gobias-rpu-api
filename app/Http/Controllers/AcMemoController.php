<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\AcMemoService;

class AcMemoController extends Controller
{
    public function store(Request $request, AcMemoService $acMemoService): \Illuminate\Http\JsonResponse
    {
        $storeAuditMemo = $acMemoService->store($request);
//        dd($storeAuditQuery);
        if (isSuccessResponse($storeAuditMemo)) {
            $response = responseFormat('success', $storeAuditMemo['data']);
        } else {
            $response = responseFormat('error', $storeAuditMemo['data']);
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
