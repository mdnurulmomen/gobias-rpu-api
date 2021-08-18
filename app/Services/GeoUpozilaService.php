<?php

namespace App\Services;

use App\Repository\Eloquent\GeoUpozilaRepository;
use Illuminate\Http\Request;

class GeoUpozilaService
{
    public function __construct(GeoUpozilaRepository $geoUpozilaRepository)
    {
        $this->geoUpozilaRepository = $geoUpozilaRepository;
    }


    public function getUpozilaDistrictWise(Request $request){
        try {
            $geoDivisionList = $this->geoUpozilaRepository->getUpozilaDistrictWise($request);
            return ['status' => 'success', 'data' => $geoDivisionList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
