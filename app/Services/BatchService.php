<?php

namespace App\Services;


use App\Repository\Eloquent\BatchRepository;
use Illuminate\Http\Request;

class BatchService
{
    public function __construct(BatchRepository $batchRepository)
    {
        $this->batchRepository = $batchRepository;
    }

    public function list(Request $request){
        try {
            $batchList = $this->batchRepository->list($request);
            return ['status' => 'success', 'data' => $batchList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
