<?php


namespace App\Http\Controllers;

use App\Http\Requests\Employee\Store\StoreEmployeeTrainingRequest;
use App\Http\Requests\Employee\Update\UpdateEmployeeTrainingRequest;
use App\Services\EmployeeTrainingService;
use Illuminate\Http\Request;

class EmployeeTrainingController extends Controller
{
    public function store(StoreEmployeeTrainingRequest $request, EmployeeTrainingService $employeeTrainingService): \Illuminate\Http\JsonResponse
    {
        $storeEmployeeTraining = $employeeTrainingService->store($request);
        if (isSuccessResponse($storeEmployeeTraining)) {
            $response = responseFormat('success', $storeEmployeeTraining['data']);
        } else {
            $response = responseFormat('error', $storeEmployeeTraining['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateEmployeeTrainingRequest $request, EmployeeTrainingService $employeeTrainingService): \Illuminate\Http\JsonResponse
    {
        $updateEmployeeTraining = $employeeTrainingService->update($request);
        if (isSuccessResponse($updateEmployeeTraining)) {
            $response = responseFormat('success', $updateEmployeeTraining['data']);
        } else {
            $response = responseFormat('error', $updateEmployeeTraining['data']);
        }
        return response()->json($response);
    }

    public function show(Request $request,EmployeeTrainingService $employeeTrainingService): \Illuminate\Http\JsonResponse
    {
        $employeeTrainingInfo = $employeeTrainingService->show($request);
        if (isSuccessResponse($employeeTrainingInfo)) {
            $response = responseFormat('success', $employeeTrainingInfo['data']);
        } else {
            $response = responseFormat('error', $employeeTrainingInfo['data']);
        }
        return response()->json($response);
    }

}
