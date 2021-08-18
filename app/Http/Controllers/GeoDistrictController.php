<?php

namespace App\Http\Controllers;

use App\Services\GeoDistrictService;
use Illuminate\Http\Request;

class GeoDistrictController extends Controller
{
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
