<?php

namespace App\Services;

use App\Repository\Eloquent\GeoDivisionRepository;
use Illuminate\Http\Request;

class GeoDivisionService
{
    public function __construct(GeoDivisionRepository $geoDivisionRepository)
    {
        $this->geoDivisionRepository = $geoDivisionRepository;
    }


    public function list(Request $request){
        try {
            $geoDivisionList = $this->geoDivisionRepository->list($request);
            return ['status' => 'success', 'data' => $geoDivisionList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
