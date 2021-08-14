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
        $office_unit->created_by = $cdesk->user_id;
        $office_unit->modified_by = $cdesk->user_id;
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
        $office_unit->modified_by = $cdesk->user_id;
        $office_unit->save();
    }

    public function show($unit_id)
    {
       return OfficeUnit::where('id',$unit_id)->get()->toArray();
    }

    public function list(Request $request)
    {
        if ($request->per_page && !$request->all) {
            return OfficeUnit::paginate($request->per_page);
        } else {
            return OfficeUnit::all();
        }
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
