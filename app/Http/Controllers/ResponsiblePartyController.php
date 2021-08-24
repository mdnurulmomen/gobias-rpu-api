<?php

namespace App\Http\Controllers;
use App\Http\Requests\ResponsibleParty\UpdateResponsiblePartyRequest;
use App\Http\Requests\ResponsibleParty\StoreResponsiblePartyRequest;
use App\Services\ResponsiblePartyService;
use Illuminate\Http\Request;

class ResponsiblePartyController extends Controller
{
    public function store(StoreResponsiblePartyRequest $request, ResponsiblePartyService $responsible_party): \Illuminate\Http\JsonResponse
    {
        $store_responsible_party = $responsible_party->store($request);
        if (isSuccessResponse($store_responsible_party)) {
            $response = responseFormat('success', $store_responsible_party['data']);
        } else {
            $response = responseFormat('error', $store_responsible_party['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateResponsiblePartyRequest $request, ResponsiblePartyService $responsible_party): \Illuminate\Http\JsonResponse
    {
        $update_responsible_party = $responsible_party->update($request);
        if (isSuccessResponse($update_responsible_party)) {
            $response = responseFormat('success', $update_responsible_party['data']);
        } else {
            $response = responseFormat('error', $update_responsible_party['data']);
        }
        return response()->json($response);
    }

    public function show(Request $request, ResponsiblePartyService $responsible_party): \Illuminate\Http\JsonResponse
    {
        $responsible_party_info = $responsible_party->show($request->responsible_party_id);
        if (isSuccessResponse($responsible_party_info)) {
            $response = responseFormat('success', $responsible_party_info['data']);
        } else {
            $response = responseFormat('error', $responsible_party_info['data']);
        }
        return response()->json($response);
    }

    public function list(Request $request, ResponsiblePartyService $responsible_party): \Illuminate\Http\JsonResponse
    {
        $responsible_party_list = $responsible_party->list($request);
        if (isSuccessResponse($responsible_party_list)) {
            $response = responseFormat('success', $responsible_party_list['data']);
        } else {
            $response = responseFormat('error', $responsible_party_list['data']);
        }
        return response()->json($response);
    }

    public function getCostCenterOffice(Request $request, ResponsiblePartyService $responsible_party): \Illuminate\Http\JsonResponse
    {
        $cost_center_office_list = $responsible_party->getCostCenterOffice($request);
        if (isSuccessResponse($cost_center_office_list)) {
            $response = responseFormat('success', $cost_center_office_list['data']);
        } else {
            $response = responseFormat('error', $cost_center_office_list['data']);
        }
        return response()->json($response);
    }

    public function getCostCenterUnit(Request $request, ResponsiblePartyService $responsible_party): \Illuminate\Http\JsonResponse
    {
        $cost_center_unit_list = $responsible_party->getCostCenterUnit($request);
        if (isSuccessResponse($cost_center_unit_list)) {
            $response = responseFormat('success', $cost_center_unit_list['data']);
        } else {
            $response = responseFormat('error', $cost_center_unit_list['data']);
        }
        return response()->json($response);
    }

}
