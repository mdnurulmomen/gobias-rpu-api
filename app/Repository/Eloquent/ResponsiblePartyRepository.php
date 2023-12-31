<?php

namespace App\Repository\Eloquent;

use App\Models\ResponsibleParty;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class ResponsiblePartyRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        $responsible_party = new ResponsibleParty;
        $responsible_party->directorate_id = $request->directorate_id;
        $responsible_party->directorate_name_bn = $request->directorate_name_bn;
        $responsible_party->directorate_name_en = $request->directorate_name_en;
        $responsible_party->office_ministry_id = $request->office_ministry_id;
        $responsible_party->controlling_office_layer_id = $request->controlling_office_layer_id;
        $responsible_party->controlling_office_id = $request->controlling_office_id;
        $responsible_party->parent_office_layer_id = $request->parent_office_layer_id;
        $responsible_party->parent_office_id = $request->parent_office_id;
        $responsible_party->cost_center_layer_id = $request->cost_center_layer_id;

        if (is_numeric($request->cost_center_layer_id)){
            $responsible_party->cost_center_layer_id = $request->cost_center_layer_id;
            $responsible_party->cost_center_type = 'OFFICE';
        }else{
            $responsible_party->cost_center_layer_id = 0;
            $responsible_party->cost_center_type = $request->cost_center_layer_id;
        }

        $responsible_party->cost_center_id = $request->cost_center_id;
        $responsible_party->created_by = $cdesk->user_primary_id;
        $responsible_party->modified_by = $cdesk->user_primary_id;
        $responsible_party->save();
        return $responsible_party->id;
    }

    public function update(Request $request, $cdesk)
    {
        $responsible_party = ResponsibleParty::find($request->id);
        $responsible_party->directorate_id = $request->directorate_id;
        $responsible_party->office_ministry_id = $request->office_ministry_id;
        $responsible_party->controlling_office_layer_id = $request->controlling_office_layer_id;
        $responsible_party->controlling_office_id = $request->controlling_office_id;
        $responsible_party->parent_office_layer_id = $request->parent_office_layer_id;
        $responsible_party->parent_office_id = $request->parent_office_id;
        $responsible_party->cost_center_layer_id = $request->cost_center_layer_id;
        $responsible_party->cost_center_id = $request->cost_center_id;
        $responsible_party->cost_center_type = $request->cost_center_type;
        $responsible_party->created_by = $cdesk->user_primary_id;
        $responsible_party->modified_by = $cdesk->user_primary_id;
        $responsible_party->save();
    }

    public function show($responsible_party_id)
    {
       return ResponsibleParty::where('id',$responsible_party_id)->get()->toArray();
    }

    public function list(Request $request)
    {
        $directorate_id = $request->directorate_id;
        $office_ministry_id = $request->office_ministry_id;
        $controlling_office_layer_id = $request->controlling_office_layer_id;
        $controlling_office_id = $request->controlling_office_id;
        $parent_office_layer_id = $request->parent_office_layer_id;
        $parent_office_id = $request->parent_office_id;
        $cost_center_layer_id = $request->cost_center_layer_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_type = $request->cost_center_type;

        $query = ResponsibleParty::query();

        $query->when($directorate_id, function ($q, $directorate_id) {
            return $q->where('directorate_id', $directorate_id);
        });

        $query->when($office_ministry_id, function ($q, $office_ministry_id) {
            return $q->where('office_ministry_id', $office_ministry_id);
        });

        $query->when($controlling_office_layer_id, function ($q, $controlling_office_layer_id) {
            return $q->where('controlling_office_layer_id', $controlling_office_layer_id);
        });

        $query->when($controlling_office_id, function ($q, $controlling_office_id) {
            return $q->where('controlling_office_id', $controlling_office_id);
        });

        $query->when($parent_office_layer_id, function ($q, $parent_office_layer_id) {
            return $q->where('parent_office_layer_id', $parent_office_layer_id);
        });

        $query->when($parent_office_id, function ($q, $parent_office_id) {
            return $q->where('parent_office_id', $parent_office_id);
        });

        $query->when($cost_center_layer_id, function ($q, $cost_center_layer_id) {
            return $q->where('cost_center_layer_id', $cost_center_layer_id);
        });

        $query->when($cost_center_id, function ($q, $cost_center_id) {
            return $q->where('cost_center_id', $cost_center_id);
        });

        $query->when($cost_center_type, function ($q, $cost_center_type) {
            return $q->where('cost_center_type', 'LIKE',"%{$cost_center_type}%");
        });

        if($request->per_page){
            return $query->paginate($request->per_page)->toArray();
        }else{
            return $query->with(array('office_ministry' => function($query) {
                $query->select('id','name_bng');
            }))->with(array('controlling_office_layer' => function($query) {
                $query->select('id','layer_name_bng');
            }))->with(array('cost_center_layer' => function($query) {
                $query->select('id','layer_name_bng');
            }))->with(array('parent_office_layer' => function($query) {
                $query->select('id','layer_name_bng');
            }))->with(array('controlling_office' => function($query) {
                $query->select('id','office_name_bng');
            }))->with(array('parent' => function($query) {
                $query->select('id','office_name_bng');
            }))->with(array('cost_center_office' => function($query) {
                $query->select('id','office_name_bng');
            }))->with(array('cost_center_unit' => function($query) {
                $query->select('id','unit_name_bng');
            }))->with(array('cost_center_employee' => function($query) {
                $query->select('id','name_bng');
            }))->get()->toArray();
        }

    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
