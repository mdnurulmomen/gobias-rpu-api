<?php

namespace App\Repository\Eloquent;

use App\Models\OfficeLayer;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OfficeLayerRepository implements BaseRepositoryInterface
{

    //create
    public function store(Request $request, $cdesk)
    {
        if ($request->id !== null) {
            $officeLayer = OfficeLayer::find($request->id);
        }
        else{
            $officeLayer = new OfficeLayer();
        }
        $officeLayer->office_ministry_id = $request->office_ministry_id;
        $officeLayer->custom_layer_id = $request->custom_layer_id;
        $officeLayer->parent_layer_id = $request->parent_layer_id;
        $officeLayer->layer_level = trim($request->layer_level);
        $officeLayer->layer_sequence = $request->layer_sequence;
        $officeLayer->layer_name_bng = trim($request->layer_name_bng);
        $officeLayer->layer_name_eng = trim($request->layer_name_eng);
        $officeLayer->created_by = $cdesk->user_primary_id;
        $officeLayer->modified_by = $cdesk->user_primary_id;
        $officeLayer->save();
    }

    //update
    public function update(Request $request, $cdesk)
    {
        $officeLayer = OfficeLayer::find($request->id);
        $officeLayer->office_ministry_id = $request->office_ministry_id;
        $officeLayer->custom_layer_id = $request->custom_layer_id;
        $officeLayer->parent_layer_id = $request->parent_layer_id;
        $officeLayer->layer_level = $request->layer_level;
        $officeLayer->layer_sequence = $request->layer_sequence;
        $officeLayer->layer_name_bng = $request->layer_name_bng;
        $officeLayer->layer_name_eng = $request->layer_name_eng;
        $officeLayer->created_by = $cdesk->user_primary_id;
        $officeLayer->modified_by = $cdesk->user_primary_id;
        $officeLayer->save();
    }

    //show
    public function show($officeLayerId){
        return OfficeLayer::where('id',$officeLayerId)->first()->toArray();
    }

    //list
    public function list(Request $request)
    {
        $office_ministry_id = $request->office_ministry_id;
        $parent_layer_id = $request->parent_layer_id;
        $layer_name_bng = $request->layer_name_bng;
        $layer_name_eng = $request->layer_name_eng;
        $custom_layer_id = $request->custom_layer_id;
        $layer_level = $request->layer_level;
        $active_status = $request->active_status;
        $created_by = $request->created_by;
        $modified_by = $request->modified_by;

        $query = OfficeLayer::query();

        $query->when($office_ministry_id, function ($q, $office_ministry_id) {
            return $q->where('office_ministry_id', $office_ministry_id);
        });

        $query->when($parent_layer_id, function ($q, $parent_layer_id) {
            return $q->where('parent_layer_id', $parent_layer_id);
        });

        $query->when($layer_name_bng, function ($q, $layer_name_bng) {
            return $q->where('layer_name_bng', 'LIKE',"%{$layer_name_bng}%");
        });

        $query->when($layer_name_eng, function ($q, $layer_name_eng) {
            return $q->where('layer_name_eng', 'LIKE',"%{$layer_name_eng}%");
        });

        $query->when($custom_layer_id, function ($q, $custom_layer_id) {
            return $q->where('custom_layer_id', $custom_layer_id);
        });

        $query->when($layer_level, function ($q, $layer_level) {
            return $q->where('layer_level', $layer_level);
        });

        $query->when($active_status, function ($q, $active_status) {
            return $q->where('active_status', $active_status);
        });

        $query->when($created_by, function ($q, $created_by) {
            return $q->where('created_by', $created_by);
        });

        $query->when($modified_by, function ($q, $modified_by) {
            return $q->where('modified_by', $modified_by);
        });

        if($request->per_page){
            return $query->paginate($request->per_page)->toArray();
        }else{
            return $query->get()->toArray();
        }

    }

    //get layer ministry wise
    public function getOfficeLayerMinistryWise($ministryId)
    {
        return OfficeLayer::with(['parent'])
            ->select('id','layer_name_eng','layer_name_bng','layer_name_eng AS layer_name_en', 'layer_name_bng AS layer_name_bn','parent_layer_id')
            ->where('office_ministry_id', $ministryId)
            ->get()->toArray();
    }

    //get layer tree ministry wise
    public function getOfficeLayerTreeMinistryWise($ministryId)
    {
        return OfficeLayer::with(['child'])->where('office_ministry_id',$ministryId)
            ->select('id', 'layer_name_eng', 'layer_name_bng')
            ->where('parent_layer_id', 0)
            ->get()
            ->toArray();
    }


    //delete
    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

}
