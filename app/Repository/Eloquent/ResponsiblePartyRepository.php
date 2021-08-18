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
        $responsible_party->office_ministry_id = $request->office_ministry_id;
        $responsible_party->controlling_office_layer_id = $request->controlling_office_layer_id;
        $responsible_party->controlling_office_id = $request->controlling_office_id;
        $responsible_party->parent_office_layer_id = $request->parent_office_layer_id;
        $responsible_party->parent_office_id = $request->parent_office_id;
        $responsible_party->cost_center_layer_id = $request->cost_center_layer_id;
        $responsible_party->cost_center_id = $request->cost_center_id;
        $responsible_party->cost_center_type = $request->cost_center_type;
        $responsible_party->created_by = $cdesk->user_id;
        $responsible_party->modified_by = $cdesk->user_id;
        $responsible_party->save();
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
        $responsible_party->created_by = $cdesk->user_id;
        $responsible_party->modified_by = $cdesk->user_id;
        $responsible_party->save();
    }

    public function show($responsible_party_id)
    {
       return ResponsibleParty::where('id',$responsible_party_id)->get()->toArray();
    }

    public function list(Request $request)
    {
        if ($request->per_page && !$request->all) {
            return ResponsibleParty::paginate($request->per_page);
        } else {
            return ResponsibleParty::all();
        }
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
