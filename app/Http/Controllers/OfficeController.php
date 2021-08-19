<?php

namespace App\Http\Controllers;
use App\Http\Requests\Office\StoreOfficeRequest;
use App\Http\Requests\Office\UpdateOfficeRequest;
use Illuminate\Http\Request;
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
        $office_info = $officeServices->show($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

    public function searchOffice(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $officeSearchList = $officeServices->searchOffice($request);
        if (isSuccessResponse($officeSearchList)) {
            $response = responseFormat('success', $officeSearchList['data']);
        } else {
            $response = responseFormat('error', $officeSearchList['data']);
        }
        return response()->json($response);
    }

    public function get_office_ministry_and_layer_wise(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeServices->get_office_ministry_and_layer_wise($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

    public function employeeDatatable(Request $request,OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $officeList = $officeServices->officeDatatable($request);
        if (isSuccessResponse($officeList)) {
            $response = responseFormat('success', $officeList['data']);
        } else {
            $response = responseFormat('error', $officeList['data']);
        }
        return response()->json($response);
    }


}
