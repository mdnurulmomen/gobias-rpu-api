<?php

namespace App\Repository\Eloquent;

use App\Models\CostCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CostCenterRepository
{
    public function store(Request $request, $officeId)
    {
        $cost_center = new CostCenter;
        $cost_center->office_id = $officeId;
        $cost_center->office_ministry_id = $request->office_ministry_id;
        $cost_center->office_layer_id = $request->office_layer_id;
        $cost_center->custom_layer_id = $request->custom_layer_id;
        $cost_center->created_at = date('Y-m-d H:i:s');
        $cost_center->save();
    }

    public function costCenterStore(Request $request)
    {
        foreach ($request->cost_center_list as $cost_center_office) {
            $exist = CostCenter::select('office_id')->where('office_id',$cost_center_office['office_id'])->first()->office_id;
            if($exist){
                continue;
            }
            $cost_center = new CostCenter;
            $cost_center->office_id = $cost_center_office['office_id'];
            $cost_center->office_ministry_id = $request->ministry_id;
            $cost_center->parent_office_id = $cost_center_office['parent_office_id'];
            $cost_center->office_layer_id = $cost_center_office['office_layer_id'];
            $cost_center->custom_layer_id = $cost_center_office['custom_layer_id'];
            $cost_center->created_at = date('Y-m-d H:i:s');
            $cost_center->save();
        }
    }

    public function update(Request $request, $cdesk)
    {
        // TODO: Implement update() method.
    }

    //show
    public function show($id)
    {
        // TODO: Implement update() method.
    }

    //delete
    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    //list
    public function list(Request $request)
    {
       return CostCenter::with('parent_with_office','office:id,office_ministry_id,office_name_eng,office_name_bng','office_ministry:id,name_bng,name_eng')->get();
    }
}
