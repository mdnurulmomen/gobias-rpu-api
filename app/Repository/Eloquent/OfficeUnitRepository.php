<?php

namespace App\Repository\Eloquent;

use App\Models\OfficeUnit;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class OfficeUnitRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        $office_unit = new OfficeUnit;
        $office_unit->office_ministry_id = $request->office_ministry_id;
        $office_unit->office_unit_category = $request->office_unit_category;
        $office_unit->office_layer_id = $request->office_layer_id;
        $office_unit->office_id = $request->office_id;
        $office_unit->parent_unit_id = $request->parent_unit_id;
        $office_unit->unit_name_bng = $request->unit_name_bng;
        $office_unit->unit_name_eng = $request->unit_name_eng;
        $office_unit->created_by = $cdesk->user_primary_id;
        $office_unit->modified_by = $cdesk->user_primary_id;
        $office_unit->save();
    }

    public function update(Request $request, $cdesk)
    {
        $office_unit = OfficeUnit::find($request->id);
        $office_unit->office_ministry_id = $request->office_ministry_id;
        $office_unit->office_unit_category = $request->office_unit_category;
        $office_unit->parent_unit_id = $request->parent_unit_id;
        $office_unit->office_layer_id = $request->office_layer_id;
        $office_unit->office_id = $request->office_id;
        $office_unit->unit_name_bng = $request->unit_name_bng;
        $office_unit->unit_name_eng = $request->unit_name_eng;
        $office_unit->modified_by = $cdesk->user_primary_id;
        $office_unit->save();
    }

    public function show($unit_id)
    {
       return OfficeUnit::where('id',$unit_id)->first()->toArray();
    }

    public function list(Request $request)
    {
        $office_ministry_id = $request->office_ministry_id;
        $office_unit_category = $request->office_unit_category;
        $parent_unit_id = $request->parent_unit_id;
        $office_layer_id = $request->office_layer_id;
        $office_id = $request->office_id;
        $unit_name_bng = $request->unit_name_bng;
        $unit_name_eng = $request->unit_name_eng;
        $created_by = $request->created_by;
        $modified_by = $request->modified_by;

        $query = OfficeUnit::query();


        $query->when($unit_name_bng, function ($q, $unit_name_bng) {
            return $q->where('unit_name_bng', 'LIKE',"%{$unit_name_bng}%");
        });

        $query->when($unit_name_eng, function ($q, $unit_name_eng) {
            return $q->where('unit_name_eng', 'LIKE',"%{$unit_name_eng}%");
        });

        $query->when($office_ministry_id, function ($q, $office_ministry_id) {
            return $q->where('office_ministry_id', $office_ministry_id);
        });

        $query->when($office_unit_category, function ($q, $office_unit_category) {
            return $q->where('office_unit_category', $office_unit_category);
        });

        $query->when($parent_unit_id, function ($q, $parent_unit_id) {
            return $q->where('parent_unit_id', $parent_unit_id);
        });

        $query->when($office_layer_id, function ($q, $office_layer_id) {
            return $q->where('office_layer_id', $office_layer_id);
        });

        $query->when($office_id, function ($q, $office_id) {
            return $q->where('office_id', $office_id);
        });

        $query->when($created_by, function ($q, $created_by) {
            return $q->where('created_by', $created_by);
        });

        $query->when($modified_by, function ($q, $modified_by) {
            return $q->where('modified_by', $modified_by);
        });

        if ($request->per_page) {
            return $query->paginate($request->per_page);
        } else {
            return $query->get()->toArray();
        }
    }

    public function getOfficeUnitMinistryLayerAndOfficeWise(Request $request)
    {
        return OfficeUnit::with(['child'])->where('office_ministry_id', $request->office_ministry_id)->where('office_layer_id', $request->office_layer_id)->where('office_id', $request->office_id)->where('parent_unit_id', 0)->get();
    }

    public function getCostCenterUnit(Request $request)
    {
       return OfficeUnit::where('office_ministry_id', $request->office_ministry_id)->where('office_id', $request->parent_office_id)->select('id', 'unit_name_bng','unit_name_eng')->get()->toArray();
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
