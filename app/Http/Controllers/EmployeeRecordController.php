<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\Store\StoreEmployeeRecordRequest;
use App\Http\Requests\Employee\Update\UpdateEmployeeRecordRequest;
use App\Services\EmployeeRecordService;
use Illuminate\Http\Request;

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

    public function show(Request $request,EmployeeRecordService $employeeRecordService): \Illuminate\Http\JsonResponse
    {
        $employeeInfo = $employeeRecordService->show($request);
        if (isSuccessResponse($employeeInfo)) {
            $response = responseFormat('success', $employeeInfo['data']);
        } else {
            $response = responseFormat('error', $employeeInfo['data']);
        }
        return response()->json($response);
    }

    public function search(Request $request,EmployeeRecordService $employeeRecordService): \Illuminate\Http\JsonResponse
    {
        $employeeSearchResult = $employeeRecordService->search($request);
        if (isSuccessResponse($employeeSearchResult)) {
            $response = responseFormat('success', $employeeSearchResult['data']);
        } else {
            $response = responseFormat('error', $employeeSearchResult['data']);
        }
        return response()->json($response);
    }

    public function profile(Request $request,EmployeeRecordService $employeeRecordService): \Illuminate\Http\JsonResponse
    {
        $employeeInfo = $employeeRecordService->profile($request);
        if (isSuccessResponse($employeeInfo)) {
            $response = responseFormat('success', $employeeInfo['data']);
        } else {
            $response = responseFormat('error', $employeeInfo['data']);
        }
        return response()->json($response);
    }

    public function employeeDatatable(Request $request,EmployeeRecordService $employeeRecordService): \Illuminate\Http\JsonResponse
    {
        $employeeList = $employeeRecordService->employeeDatatable($request);
        if (isSuccessResponse($employeeList)) {
            $response = responseFormat('success', $employeeList['data']);
        } else {
            $response = responseFormat('error', $employeeList['data']);
        }
        return response()->json($response);
    }
}
