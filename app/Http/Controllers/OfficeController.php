<?php

namespace App\Http\Controllers;
use App\Repository\Eloquent\OfficeRepository;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOfficeRequest;
use App\Services\OfficeServices;

class OfficeController extends Controller
{
    public function storeOffice(StoreOfficeRequest $request, OfficeServices $officeServices): \Illuminate\Http\JsonResponse
    {
        $store_office = $officeServices->storeOffice($request);
        if (isSuccessResponse($store_office)) {
            $response = responseFormat('success', $store_office['data']);
        } else {
            $response = responseFormat('error', $store_office['data']);
        }
        return response()->json($response);
    }

    public function getOfficeInfo(Request $request,OfficeRepository $officeRepository): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeRepository->get_office_info($request->office_id);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }
}
