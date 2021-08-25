<?php

namespace App\Http\Controllers;

use App\Services\GeoCountryService;
use Illuminate\Http\Request;

class GeoCountryController extends Controller
{
    public function list(Request $request, GeoCountryService $geoCountryService): \Illuminate\Http\JsonResponse
    {
        $geoCountryList = $geoCountryService->list($request);
        if (isSuccessResponse($geoCountryList)) {
            $response = responseFormat('success', $geoCountryList['data']);
        }
        else {
            $response = responseFormat('error', $geoCountryList['data']);
        }
        return response()->json($response);
    }
}
