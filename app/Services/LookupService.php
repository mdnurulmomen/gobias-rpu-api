<?php

namespace App\Services;

use App\Repository\Eloquent\LookupRepository;
use Illuminate\Http\Request;

class LookupService
{
    public function __construct(LookupRepository $lookupRepository)
    {
        $this->lookupRepository = $lookupRepository;
    }

    public function getLookupTypeWise(Request $request){
        try {
            $geoDistrictList = $this->lookupRepository->getLookupTypeWise($request);
            return ['status' => 'success', 'data' => $geoDistrictList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
