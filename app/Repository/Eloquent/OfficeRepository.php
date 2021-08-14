<?php

namespace App\Repository\Eloquent;

use App\Models\Office;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OfficeRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        $office = new Office;
        $office->office_ministry_id = $request->office_ministry_id;
        $office->office_layer_id = $request->office_layer_id;
        $office->custom_layer_id = $request->office_layer_id;
        $office->parent_office_id = $request->parent_office_id;
        $office->geo_division_id = $request->geo_division_id;
        $office->geo_district_id = $request->geo_district_id;
        $office->geo_upazila_id = $request->geo_upazila_id;
        $office->geo_union_id = $request->geo_union_id != null ? $request->geo_union_id : 0;
        $office->office_name_eng = $request->office_name_eng;
        $office->office_name_bng = $request->office_name_bng;
        $office->office_address = $request->office_address;
        $office->office_phone = $request->office_phone;
        $office->office_mobile = $request->office_mobile;
        $office->office_fax = $request->office_fax;
        $office->office_email = $request->office_email;
        $office->office_web = $request->office_web;
        $office->date_of_formation = empty($request->date_of_formation)?null:date('Y-m-d', strtotime($request->date_of_formation));
        $office->date_of_close = empty($request->date_of_close)?null:date('Y-m-d', strtotime($request->date_of_close));
        $office->office_status = $request->office_status;
        $office->actual_strength = $request->actual_strength;
        $office->office_description = trim($request->office_description);
        $office->office_details = trim($request->office_details);
        $office->created_by = $cdesk->user_primary_id;
        $office->modified_by = $cdesk->user_primary_id;
        $office->save();

        $lastInsertId = $office->id;
        return $lastInsertId;
    }

    public function show($officeId){
        return Office::where('id',$officeId)->first()->toArray();
    }

    public function update(Request $request, $cdesk)
    {
        $office = Office::find($request->id);
        $office->office_ministry_id = $request->office_ministry_id;
        $office->office_layer_id = $request->office_layer_id;
        $office->custom_layer_id = $request->office_layer_id;
        $office->parent_office_id = $request->parent_office_id;
        $office->geo_division_id = $request->geo_division_id;
        $office->geo_district_id = $request->geo_district_id;
        $office->geo_upazila_id = $request->geo_upazila_id;
        $office->geo_union_id = $request->geo_union_id != null ? $request->geo_union_id : 0;
        $office->office_name_eng = $request->office_name_eng;
        $office->office_name_bng = $request->office_name_bng;
        $office->office_address = $request->office_address;
        $office->office_phone = $request->office_phone;
        $office->office_mobile = $request->office_mobile;
        $office->office_fax = $request->office_fax;
        $office->office_email = $request->office_email;
        $office->office_web = $request->office_web;
        $office->date_of_formation = empty($request->date_of_formation)?null:date('Y-m-d', strtotime($request->date_of_formation));
        $office->date_of_close = empty($request->date_of_close)?null:date('Y-m-d', strtotime($request->date_of_close));
        $office->office_status = $request->office_status;
        $office->actual_strength = $request->actual_strength;
        $office->office_description = trim($request->office_description);
        $office->office_details = trim($request->office_details);
        $office->created_by = $cdesk->user_primary_id;
        $office->modified_by = $cdesk->user_primary_id;
        $office->save();

        $lastInsertId = $office->id;
        return $lastInsertId;
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
