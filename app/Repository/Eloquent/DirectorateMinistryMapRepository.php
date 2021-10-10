<?php

namespace App\Repository\Eloquent;

use App\Models\DirectorateMinistryMap;
use App\Models\ResponsibleParty;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class DirectorateMinistryMapRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        $directorate_ministry_map = new DirectorateMinistryMap;
        $directorate_ministry_map->directorate_id = $request->directorate_id;
        $directorate_ministry_map->directorate_name_bn = $request->directorate_name_bn;
        $directorate_ministry_map->directorate_name_en = $request->directorate_name_en;
        $directorate_ministry_map->office_ministry_id = $request->office_ministry_id;
        $directorate_ministry_map->created_by = $cdesk->user_primary_id;
        $directorate_ministry_map->save();
    }

    public function update(Request $request, $cdesk)
    {
        $directorate_ministry_map = DirectorateMinistryMap::find($request->directorate_ministry_map_id);
        $directorate_ministry_map->directorate_id = $request->directorate_id;
        $directorate_ministry_map->directorate_name_bn = $request->directorate_name_bn;
        $directorate_ministry_map->directorate_name_en = $request->directorate_name_en;
        $directorate_ministry_map->office_ministry_id = $request->office_ministry_id;
        $directorate_ministry_map->updated_by = $cdesk->user_primary_id;
        $directorate_ministry_map->save();
    }

    public function show($directorate_ministry_map_id)
    {
       return DirectorateMinistryMap::where('id',$directorate_ministry_map_id)->first()->toArray();
    }

    public function list(Request $request)
    {
        return DirectorateMinistryMap::with('directorate_ministry')->get()->toArray();
    }

    public function getDirectorWiseMinistryList(Request $request)
    {
        return DirectorateMinistryMap::with('directorate_ministry')->where('directorate_id',$request->directorate_id)->get()->toArray();
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
