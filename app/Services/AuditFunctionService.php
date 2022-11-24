<?php

namespace App\Services;

use App\Models\AuditFunction;
use Illuminate\Http\Request;

class AuditFunctionService
{
    public function store(Request $request): array
    {
        try {
            //
            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function list(Request $request)
    {
        try {
            $functions = AuditFunction::orderBy('total_risk_score', 'DESC')->get()->sortDesc();
            return ['status' => 'success', 'data' => $functions];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function show(Request $request)
    {
        try {
//            $function = Project::with('project_doner')->where('id', $request->id)->first()->toArray();
//            return ['status' => 'success', 'data' => $function];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function update(Request $request): array
    {
        try {
            $function = AuditFunction::find($request->id);

            $function->name_en = $request->name_en ? $request->name_en : $function->name_en;
            $function->name_bn = $request->name_bn ? $request->name_bn : $function->name_bn;
            $function->type = $request->type ? $request->type : $function->type;
            $function->status = $request->status ? $request->status : $function->status;
            $function->total_risk_score = $request->total_risk_score ? $request->total_risk_score : $function->total_risk_score;
            $function->risk_score_key = $request->risk_score_key ? $request->risk_score_key : $function->risk_score_key;
            $function->updated_by = $request->updated_by ? $request->updated_by : $function->updated_by;

            $function->save();

            return ['status' => 'success', 'data' => 'Updated Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
}
