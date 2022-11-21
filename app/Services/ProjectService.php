<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectsDonarAgencies;
use Illuminate\Http\Request;

class ProjectService
{
    public function store(Request $request): array
    {
        try {
            $project = new Project();
            $project->name_bn = $request->name_bn;
            $project->name_en = $request->name_en;
            $project->directorate_id = $request->directorate_id;
            $project->save();
            $donar_agency_ids = $request->donar_agency_id;
            foreach ($donar_agency_ids as $donar_agency_id) {
                $projects_donar_agencies = new ProjectsDonarAgencies();
                $projects_donar_agencies->donar_agency_id = $donar_agency_id;
                $projects_donar_agencies->project_id = $project->id;
                $projects_donar_agencies->save();
            }

            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function list(Request $request)
    {
        try {
            $project = Project::get()->sortDesc();
            return ['status' => 'success', 'data' => $project];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function show(Request $request)
    {
        try {
            $project = Project::with('project_doner')->where('id', $request->id)->first()->toArray();

            return ['status' => 'success', 'data' => $project];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function update(Request $request): array
    {
        try {
            $project = Project::find($request->id);

            $project->name_en = $request->name_en ? $request->name_en : $project->name_en;
            $project->name_bn = $request->name_bn ? $request->name_bn : $project->name_bn;
            $project->project_director_name = $request->project_director_name ? $request->project_director_name : $project->project_director_name;
            $project->project_director_designation = $request->project_director_designation ? $request->project_director_designation : $project->project_director_designation;
            $project->project_director_mobile = $request->project_director_mobile ? $request->project_director_mobile : $project->project_director_mobile;
            $project->project_director_email = $request->project_director_email ? $request->project_director_email : $project->project_director_email;
            $project->project_start_date = $request->project_start_date ? $request->project_start_date : $project->project_start_date;
            $project->project_end_date = $request->project_end_date ? $request->project_end_date : $project->project_end_date;
            $project->total_risk_score = $request->total_risk_score ? $request->total_risk_score : $project->total_risk_score;
            $project->risk_score_key = $request->risk_score_key ? $request->risk_score_key : $project->risk_score_key;
            $project->created_by = $request->created_by ? $request->created_by : $project->created_by;
            $project->updated_by = $request->updated_by ? $request->updated_by : $project->updated_by;

            $project->save();

            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
}
