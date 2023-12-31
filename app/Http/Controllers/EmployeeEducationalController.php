<?php


namespace App\Http\Controllers;

use App\Http\Requests\Employee\Store\StoreEmployeeEducationalRequest;
use App\Http\Requests\Employee\Update\UpdateEmployeeEducationalRequest;
use App\Services\EmployeeEducationalService;
use Illuminate\Http\Request;

class EmployeeEducationalController extends Controller
{
    public function store(StoreEmployeeEducationalRequest $request, EmployeeEducationalService $employeeEducationalService): \Illuminate\Http\JsonResponse
    {
        $storeEmployeeEducation = $employeeEducationalService->store($request);
        if (isSuccessResponse($storeEmployeeEducation)) {
            $response = responseFormat('success', $storeEmployeeEducation['data']);
        } else {
            $response = responseFormat('error', $storeEmployeeEducation['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateEmployeeEducationalRequest $request, EmployeeEducationalService $employeeEducationalService): \Illuminate\Http\JsonResponse
    {
        $updateEmployeeEducation = $employeeEducationalService->update($request);
        if (isSuccessResponse($updateEmployeeEducation)) {
            $response = responseFormat('success', $updateEmployeeEducation['data']);
        } else {
            $response = responseFormat('error', $updateEmployeeEducation['data']);
        }
        return response()->json($response);
    }

    public function show(Request $request,EmployeeEducationalService $employeeEducationalService): \Illuminate\Http\JsonResponse
    {
        $employeeEducationalInfo = $employeeEducationalService->show($request);
        if (isSuccessResponse($employeeEducationalInfo)) {
            $response = responseFormat('success', $employeeEducationalInfo['data']);
        } else {
            $response = responseFormat('error', $employeeEducationalInfo['data']);
        }
        return response()->json($response);
    }

    public function getSingleEmployeeEducationList(Request $request,EmployeeEducationalService $employeeEducationalService): \Illuminate\Http\JsonResponse
    {
        $allEducationalDetails = $employeeEducationalService->getSingleEmployeeEducationList($request);
        if (isSuccessResponse($allEducationalDetails)) {
            $response = responseFormat('success', $allEducationalDetails['data']);
        } else {
            $response = responseFormat('error', $allEducationalDetails['data']);
        }
        return response()->json($response);
    }

    public function delete(Request $request,EmployeeEducationalService $employeeEducationalService): \Illuminate\Http\JsonResponse
    {
        $deleteEmpEducationalInfo = $employeeEducationalService->delete($request);
        if (isSuccessResponse($deleteEmpEducationalInfo)) {
            $response = responseFormat('success', $deleteEmpEducationalInfo['data']);
        } else {
            $response = responseFormat('error', $deleteEmpEducationalInfo['data']);
        }
        return response()->json($response);
    }

}
