<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OfficeService;

class LookupTypeController extends Controller
{
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
}
