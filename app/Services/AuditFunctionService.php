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
            $functions = AuditFunction::get()->sortDesc();
            return ['status' => 'success', 'data' => $functions];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function show(Request $request)
    {
        try {
//            $project = Project::with('project_doner')->where('id', $request->id)->first()->toArray();
//            return ['status' => 'success', 'data' => $project];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function update(Request $request): array
    {
        try {
//            ProjectsDonarAgencies::where('project_id', $request->id)->delete();
//            $donar_agency_ids = $request->donar_agency_id;
//            foreach ($donar_agency_ids as $donar_agency_id) {
//                $projects_donar_agencies = new ProjectsDonarAgencies();
//                $projects_donar_agencies->donar_agency_id = $donar_agency_id;
//                $projects_donar_agencies->project_id = $request->id;
//                $projects_donar_agencies->save();
//            }
//            $project = Project::find($request->id);
//            $project->name_bn = $request->name_bn;
//            $project->name_en = $request->name_en;
//            $project->directorate_id = $request->directorate_id;
//            $project->save();
//
//            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
}
