<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateOfficeRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOfficeRequest;
use App\Services\OfficeService;

class OfficeController extends Controller
{
    public function store(StoreOfficeRequest $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $storeOffice = $officeServices->store($request);
        if (isSuccessResponse($storeOffice)) {
            $response = responseFormat('success', $storeOffice['data']);
        } else {
            $response = responseFormat('error', $storeOffice['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateOfficeRequest $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $storeOffice = $officeServices->update($request);
        if (isSuccessResponse($storeOffice)) {
            $response = responseFormat('success', $storeOffice['data']);
        } else {
            $response = responseFormat('error', $storeOffice['data']);
        }
        return response()->json($response);
    }

    public function show(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeServices->show($request->office_id);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }
}
