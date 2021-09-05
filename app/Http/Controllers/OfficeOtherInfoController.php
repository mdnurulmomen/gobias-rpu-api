<?php

namespace App\Http\Controllers;
use App\Services\OfficeOtherInfoService;
use Illuminate\Http\Request;

class OfficeOtherInfoController extends Controller
{
    public function store(Request $request, OfficeOtherInfoService $officeOtherInfoService): \Illuminate\Http\JsonResponse
    {
        $storeOffice = $officeOtherInfoService->store($request);
        if (isSuccessResponse($storeOffice)) {
            $response = responseFormat('success', $storeOffice['data']);
        } else {
            $response = responseFormat('error', $storeOffice['data']);
        }
        return response()->json($response);
    }


    public function show(Request $request, OfficeOtherInfoService $officeOtherInfoService): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeOtherInfoService->show($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

}
