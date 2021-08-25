<?php

namespace App\Services;

use App\Models\GeoDistrict;
use App\Repository\Eloquent\GeoDistrictRepository;
use Illuminate\Http\Request;

class GeoDistrictService
{
    public function __construct(GeoDistrictRepository $geoDistrictRepository)
    {
        $this->geoDistrictRepository = $geoDistrictRepository;
    }

    public function list(Request $request){
        try {
            $geoDistrictList = $this->geoDistrictRepository->list($request);
            return ['status' => 'success', 'data' => $geoDistrictList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getDistrictDivisionWise(Request $request){
        try {
            $geoDistrictList = $this->geoDistrictRepository->getDistrictDivisionWise($request);
            return ['status' => 'success', 'data' => $geoDistrictList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
