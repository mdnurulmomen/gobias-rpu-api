<?php

namespace App\Http\Controllers;

use App\Services\DonerAgencyService;
use Illuminate\Http\Request;

class DonerAgencyController extends Controller
{
    public function store(Request $request, DonerAgencyService $donerAgencyService): \Illuminate\Http\JsonResponse
    {
        $store = $donerAgencyService->store($request);
        if (isSuccessResponse($store)) {
            $response = responseFormat('success', $store['data']);
        } else {
            $response = responseFormat('error', $store['data']);
        }

        return response()->json($response);
    }

    public function list(Request $request, DonerAgencyService $donerAgencyService): \Illuminate\Http\JsonResponse
    {
        $doneragencylist = $donerAgencyService->list($request);
        if (isSuccessResponse($doneragencylist)) {
            $response = responseFormat('success', $doneragencylist['data']);
        } else {
            $response = responseFormat('error', $doneragencylist['data']);
        }

        return response()->json($response);
    }

    public function show(Request $request, DonerAgencyService $donerAgencyService): \Illuminate\Http\JsonResponse
    {
        $doner_agency = $donerAgencyService->show($request);
        if (isSuccessResponse($doner_agency)) {
            $response = responseFormat('success', $doner_agency['data']);
        } else {
            $response = responseFormat('error', $doner_agency['data']);
        }

        return response()->json($response);
    }
    public function update(Request $request, DonerAgencyService $donerAgencyService): \Illuminate\Http\JsonResponse
    {
        $donerAgencydata = $donerAgencyService->update($request);
//
        if (isSuccessResponse($donerAgencydata)) {
            $response = responseFormat('success', $donerAgencydata['data']);
        } else {
            $response = responseFormat('error', $donerAgencydata['data']);
        }
        return response()->json($response);
    }
}
