<?php


namespace App\Http\Controllers;


use App\Http\Requests\Employee\Store\StoreEmployeeCertificateRequest;
use App\Http\Requests\Employee\Update\UpdateEmployeeCertificateRequest;
use App\Services\EmployeeCertificateService;
use Illuminate\Http\Request;

class EmployeeCertificateController extends Controller
{
    public function store(StoreEmployeeCertificateRequest $request, EmployeeCertificateService $employeeCertificateService): \Illuminate\Http\JsonResponse
    {
        $storeEmployeeCertificate = $employeeCertificateService->store($request);
        if (isSuccessResponse($storeEmployeeCertificate)) {
            $response = responseFormat('success', $storeEmployeeCertificate['data']);
        } else {
            $response = responseFormat('error', $storeEmployeeCertificate['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateEmployeeCertificateRequest $request, EmployeeCertificateService $employeeCertificateService): \Illuminate\Http\JsonResponse
    {
        $updateEmployeeCertificate = $employeeCertificateService->update($request);
        if (isSuccessResponse($updateEmployeeCertificate)) {
            $response = responseFormat('success', $updateEmployeeCertificate['data']);
        } else {
            $response = responseFormat('error', $updateEmployeeCertificate['data']);
        }
        return response()->json($response);
    }

    public function show(Request $request,EmployeeCertificateService $employeeCertificateService): \Illuminate\Http\JsonResponse
    {
        $employeeCertificateInfo = $employeeCertificateService->show($request);
        if (isSuccessResponse($employeeCertificateInfo)) {
            $response = responseFormat('success', $employeeCertificateInfo['data']);
        } else {
            $response = responseFormat('error', $employeeCertificateInfo['data']);
        }
        return response()->json($response);
    }

}
