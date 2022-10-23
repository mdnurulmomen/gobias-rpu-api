<?php

namespace App\Services;
use App\Models\CostCenterProjectMap;
use App\Models\Office;
use App\Models\OfficeMinistry;
use Illuminate\Http\Request;

class CostCenterProjectService
{
    public function store(Request $request)
    {
        try {
            CostCenterProjectMap::insert($request->project_map);
            return ['status' => 'success', 'data' => 'Project Map Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function list(Request $request)
    {
        try {
            $project_map_list = CostCenterProjectMap::with(['ministry:id,name_eng,name_bng','entity:id,office_name_eng,office_name_bng','project:id,name_en,name_bn'])->where('directorate_id',$request->directorate_id)->get();
            return ['status' => 'success', 'data' => $project_map_list];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function get_project_map_entity_list(Request $request)
    {
        try {

            $offices = CostCenterProjectMap::with(['ministry:id,name_eng,name_bng','entity:id,office_name_eng,office_name_bng,office_type','project:id,name_en,name_bn'])
                ->where('directorate_id',$request->directorate_id)
                ->where('ministry_id',$request->office_ministry_id)
                ->where('project_id',$request->project_id)
                ->get()
                ->unique('entity_id');

//            return ['status' => 'success', 'data' => $offices];

            $ministry = OfficeMinistry::find($request->office_ministry_id, ['name_eng', 'name_bng', 'id'])->toArray();

            $office_data = [];
            foreach ($offices as $office) {
                $office_data[] = [
                    'id' => $office['entity']['id'],
                    'office_type' => $office['entity']['office_type'],
                    'office_ministry_id' => $office['ministry_id'],
                    'office_layer_id' => null,
                    'office_name_bn' => $office['entity']['office_name_bn'],
                    'office_name_en' => $office['entity']['office_name_en'],
                    'child_count' => 0,
                    'has_child' => 0,
                ];
            }

            $data = ['office_ministry' => $ministry, 'offices' => $office_data];
            return ['status' => 'success', 'data' => $data];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function get_project_map_cost_center_list(Request $request)
    {
        try {

            $office_data = CostCenterProjectMap::with('office')
                ->where('entity_id', $request->parent_office_id)
                ->where('ministry_id', $request->parent_ministry_id)
                ->get()
                ->toArray();

//            return ['status' => 'success', 'data' => $office_data];

            $offices = [];
            foreach ($office_data as $office) {
                $offices[] = [
                    'id' => $office['office']['id'],
                    'office_layer_id' => $office['office']['office_layer_id'],
                    'controlling_office_layer_id' => $office['office']['controlling_office_layer_id'],
                    'controlling_office_id' => $office['office']['controlling_office_id'],
                    'custom_layer_id' => $office['office']['custom_layer_id'],
                    'office_name_bng' => $office['office']['office_name_bng'],
                    'office_name_eng' => $office['office']['office_name_eng'],
                    'office_name_bn' => $office['office']['office_name_bng'],
                    'office_name_en' => $office['office']['office_name_eng'],
                    'office_structure_type' => $office['office']['office_structure_type'],
                    'office_address' => $office['office']['office_address'],
                    'office_phone' => $office['office']['office_phone'],
                    'office_mobile' => $office['office']['office_mobile'],
                    'parent_office_id' => $office['office']['parent_office_id'],
                    'last_audit_year_start' => $office['office']['last_audit_year_start'],
                    'last_audit_year_end' => $office['office']['last_audit_year_end'],
                    'risk_category' => $office['office']['risk_category'],
                    'has_child' => 0,
                ];
            }

            return ['status' => 'success', 'data' => $offices];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function get_cost_center_project_map_list(Request $request)
    {
        $office_data = CostCenterProjectMap::with('office:id,office_name_eng,office_name_bng')
            ->with('parent_office:id,office_name_eng,office_name_bng')
            ->where('project_id', $request->project_id)
            ->get()
            ->toArray();

        return ['status' => 'success', 'data' => $office_data];

    }
}
