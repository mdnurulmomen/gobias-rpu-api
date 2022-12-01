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
            $list = UnitMasterInfo::with('auditAreas')->orderBy('total_risk_score', 'DESC')->get();
            return ['status' => 'success', 'data' => $list];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }

    }

    public function update(Request $request): array
    {
        try {
            $function = UnitMasterInfo::find($request->id);

            $function->name_en = $request->name_en ? $request->name_en : $function->name_en;
            $function->name_bn = $request->name_bn ? $request->name_bn : $function->name_bn;
            $function->total_risk_score = $request->total_risk_score ? $request->total_risk_score : $function->total_risk_score;
            $function->risk_score_key = $request->risk_score_key ? $request->risk_score_key : $function->risk_score_key;
            $function->updated_by = $request->updated_by ? $request->updated_by : $function->updated_by;

            $function->save();

            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
}
