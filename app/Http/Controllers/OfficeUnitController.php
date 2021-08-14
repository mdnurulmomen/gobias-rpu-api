<?php

namespace App\Http\Controllers;
use App\Http\Requests\OfficeUnit\UpdateOfficeUnitRequest;
use App\Http\Requests\OfficeUnit\StoreOfficeUnitRequest;
use App\Services\OfficeUnitService;
use Illuminate\Http\Request;

class OfficeUnitController extends Controller
{
    public function store(StoreOfficeUnitRequest $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $store_unit = $unit->store($request);
        if (isSuccessResponse($store_unit)) {
            $response = responseFormat('success', $store_unit['data']);
        } else {
            $response = responseFormat('error', $store_unit['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateOfficeUnitRequest $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $update_unit = $unit->update($request);
        if (isSuccessResponse($update_unit)) {
            $response = responseFormat('success', $update_unit['data']);
        } else {
            $response = responseFormat('error', $update_unit['data']);
        }
        return response()->json($response);
    }

    public function show(Request $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $unit_info = $unit->show($request->unit_id);
        if (isSuccessResponse($unit_info)) {
            $response = responseFormat('success', $unit_info['data']);
        } else {
            $response = responseFormat('error', $unit_info['data']);
        }
        return response()->json($response);
    }

    public function list(Request $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $unit_list = $unit->list($request);
        if (isSuccessResponse($unit_list)) {
            $response = responseFormat('success', $unit_list['data']);
        } else {
            $response = responseFormat('error', $unit_list['data']);
        }
        return response()->json($response);
    }

    public function get_unit_category_list(Request $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $unit_category_list = $unit->get_unit_category_list($request);
        if (isSuccessResponse($unit_category_list)) {
            $response = responseFormat('success', $unit_category_list['data']);
        } else {
            $response = responseFormat('error', $unit_category_list['data']);
        }
        return response()->json($response);
    }

}
