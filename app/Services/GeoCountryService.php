<?php
namespace App\Services;

use App\Repository\Eloquent\GeoCountryRepository;
use Illuminate\Http\Request;

class GeoCountryService
{
    public function __construct(GeoCountryRepository $geoCountryRepository)
    {
        $this->geoCountryRepository = $geoCountryRepository;
    }

    public function list(Request $request){
        try {
            $geoCountryList = $this->geoCountryRepository->list($request);
            return ['status' => 'success', 'data' => $geoCountryList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
