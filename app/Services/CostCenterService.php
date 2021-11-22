<?php

namespace App\Services;

use App\Models\Document;
use App\Repository\Eloquent\CostCenterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CostCenterService
{
    public function __construct(CostCenterRepository $costCenterRepository)
    {
        $this->costCenterRepository = $costCenterRepository;
    }

    public function store(Request $request): array
    {
        DB::beginTransaction();
        try {
            $this->costCenterRepository->costCenterStore($request);
            DB::commit();
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        }
        catch (\Exception $exception) {
            DB::rollback();
            $returnData = ['status' => 'error', 'data' => $exception];
        }

        return $returnData;
    }

    public function list(Request $request){
        try {
            $officList = $this->costCenterRepository->list($request);
            return ['status' => 'success', 'data' => $officList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }


}
