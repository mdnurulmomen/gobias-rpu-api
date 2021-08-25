<?php

namespace App\Http\Controllers;

use App\Services\GeoDistrictService;
use Illuminate\Http\Request;

class GeoDistrictController extends Controller
{
    public function list(Request $request, GeoDistrictService $geoDistrictService): \Illuminate\Http\JsonResponse
    {
        $geoDistrictList = $geoDistrictService->list($request);
        if (isSuccessResponse($geoDistrictList)) {
            $response = responseFormat('success', $geoDistrictList['data']);
        } else {
            $response = responseFormat('error', $geoDistrictList['data']);
        }
        return response()->json($response);
    }

    public function getDistrictDivisionWise(Request $request, GeoDistrictService $geoDistrictService): \Illuminate\Http\JsonResponse
    {
        $districtDivisionWise = $geoDistrictService->getDistrictDivisionWise($request);
        if (isSuccessResponse($districtDivisionWise)) {
            $response = responseFormat('success', $districtDivisionWise['data']);
        } else {
            $response = responseFormat('error', $districtDivisionWise['data']);
        }
        return response()->json($response);
    }
}
