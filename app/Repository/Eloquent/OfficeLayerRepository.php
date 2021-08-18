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

    //get layer ministry wise
    public function getOfficeLayerMinistryWise($ministryId)
    {
        return OfficeLayer::with(['parent'])
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

    public function list(Request $request)
    {
        // TODO: Implement list() method.
    }
}
