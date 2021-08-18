<?php

namespace App\Services;

use App\Repository\Eloquent\GeoDistrictRepository;
use Illuminate\Http\Request;

class GeoDistrictService
{
    public function __construct(GeoDistrictRepository $geoDistrictRepository)
    {
        $this->geoDistrictRepository = $geoDistrictRepository;
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
