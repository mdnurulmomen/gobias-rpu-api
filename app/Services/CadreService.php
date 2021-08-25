<?php

namespace App\Services;

use App\Repository\Eloquent\CadreRepository;
use Illuminate\Http\Request;

class CadreService
{
    public function __construct(CadreRepository $cadreRepository)
    {
        $this->cadreRepository = $cadreRepository;
    }

    public function list(Request $request){
        try {
            $cadreList = $this->cadreRepository->list($request);
            return ['status' => 'success', 'data' => $cadreList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
