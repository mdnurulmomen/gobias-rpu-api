<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRecordRequest;
use App\Http\Requests\UpdateEmployeeRecordRequest;
use App\Services\EmployeeRecordService;

class EmployeeRecordController extends Controller
{
    public function store(StoreEmployeeRecordRequest $request, EmployeeRecordService $employeeRecordService): \Illuminate\Http\JsonResponse
    {
        $storeEmployeeRecord = $employeeRecordService->store($request);
        if (isSuccessResponse($storeEmployeeRecord)) {
            $response = responseFormat('success', $storeEmployeeRecord['data']);
        } else {
            $response = responseFormat('error', $storeEmployeeRecord['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateEmployeeRecordRequest $request, EmployeeRecordService $employeeRecordService): \Illuminate\Http\JsonResponse
    {
        $storeEmployeeRecord = $employeeRecordService->update($request);
        if (isSuccessResponse($storeEmployeeRecord)) {
            $response = responseFormat('success', $storeEmployeeRecord['data']);
        } else {
            $response = responseFormat('error', $storeEmployeeRecord['data']);
        }
        return response()->json($response);
    }
}
