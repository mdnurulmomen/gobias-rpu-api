<?php

namespace App\Services;
use App\Models\UnitMasterInfo;
use Illuminate\Http\Request;
use DB;

class UnitMasterInfoService
{
    public function list(Request $request): array
    {
        try {
            $list = UnitMasterInfo::get();
            return ['status' => 'success', 'data' => $list];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }

    }
}
