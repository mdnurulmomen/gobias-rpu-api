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
        $directorate_ministry_map = new DirectorateMinistryMap;
        $directorate_ministry_map->directorate_id = $request->directorate_id;
        $directorate_ministry_map->directorate_name_bn = $request->directorate_name_bn;
        $directorate_ministry_map->directorate_name_en = $request->directorate_name_en;
        $directorate_ministry_map->office_ministry_id = $request->office_ministry_id;
        $directorate_ministry_map->updated_by = $cdesk->user_primary_id;
        $directorate_ministry_map->save();
    }

    public function show($directorate_ministry_map_id)
    {
       return DirectorateMinistryMap::where('id',$directorate_ministry_map_id)->get()->toArray();
    }

    //for office datatable
    public function officeDatatable(Request $request){
        $limit = $request->length;
        $start = $request->start;
        $order = $request->order;
        $dir = $request->dir;

        if (empty($request->search)) {
            $totalData = DirectorateMinistryMap::count();
            $offices = DirectorateMinistryMap::with(['ministry'])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

        else {
            $search = $request->search;

            $commonSql = DirectorateMinistryMap::with(['ministry'])
                ->where('office_name_eng', 'like', '%' .$search . '%')
                ->orWhere('office_name_bng', 'LIKE',"%{$search}%")
                ->orWhere('office_email', 'LIKE',"%{$search}%")
                ->orWhere('office_web', 'LIKE',"%{$search}%");

            $totalData = $commonSql->count();
            $offices = $commonSql->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

        $response = array(
            "offices"=> $offices,
            "totalData"=>$totalData,
            "totalFiltered"=>$totalData
        );
        return $response;
    }

    public function list(Request $request)
    {
        return DirectorateMinistryMap::all()->toArray();
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
