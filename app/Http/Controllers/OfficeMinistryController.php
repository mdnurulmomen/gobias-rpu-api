<?php

namespace App\Http\Controllers;
use App\Services\OfficeMinistryService;
use Illuminate\Http\Request;

class OfficeMinistryController extends Controller
{
    public function store(): \Illuminate\Http\JsonResponse
    {

    }

    public function update(): \Illuminate\Http\JsonResponse
    {

    }

    public function show(): \Illuminate\Http\JsonResponse
    {

    }

    public function list(Request $request, OfficeMinistryService $Office_ministry): \Illuminate\Http\JsonResponse
    {
        $ministry_list = $Office_ministry->list($request);
        if (isSuccessResponse($ministry_list)) {
            $response = responseFormat('success', $ministry_list['data']);
        } else {
            $response = responseFormat('error', $ministry_list['data']);
        }
        return response()->json($response);
    }

}
