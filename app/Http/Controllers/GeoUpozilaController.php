<?php

namespace App\Http\Controllers;

use App\Services\GeoUpozilaService;
use Illuminate\Http\Request;

class GeoUpozilaController extends Controller
{
    public function getUpozilaDistrictWise(Request $request, GeoUpozilaService $geoUpozilaService): \Illuminate\Http\JsonResponse
    {
        $getUpozilaDistrictWise = $geoUpozilaService->getUpozilaDistrictWise($request);
        if (isSuccessResponse($getUpozilaDistrictWise)) {
            $response = responseFormat('success', $getUpozilaDistrictWise['data']);
        } else {
            $response = responseFormat('error', $getUpozilaDistrictWise['data']);
        }
        return response()->json($response);
    }
}
