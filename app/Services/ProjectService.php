<?php

namespace App\Services;

use App\Models\Project;
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

            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function list(Request $request)
    {
        try {
            $project = Project::all()->sortDesc();

            return ['status' => 'success', 'data' => $project];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function show(Request $request)
    {
        try {
            $project = Project::where('id',$request->id)->first()->toArray();
            return ['status' => 'success', 'data' => $project];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
    public function update(Request $request): array
    {
        try {
            $project =Project::find($request->id);
            if(!$project){
                throw new \Exception('Donor Agency Not Found!');
            }
            $project->name_bn = $request->name_bn;
            $project->name_en = $request->name_en;
            $project->directorate_id = $request->directorate_id;
            $project->save();

            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
}
