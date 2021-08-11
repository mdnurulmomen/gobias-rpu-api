<?php

namespace App\Repository\Eloquent;

use App\Models\Office;
use App\Repository\Contracts\OfficeRepositoryInterface;
use Illuminate\Http\Request;

class OfficeRepository implements OfficeRepositoryInterface
{

    public function create(Request $request, $cdesk)
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
        $office->date_of_formation = date('Y-m-d', strtotime($request->date_of_formation));
        $office->date_of_close = date('Y-m-d', strtotime($request->date_of_close));
        $office->office_status = $request->office_status;
        $office->actual_strength = $request->actual_strength;
        $office->office_description = trim($request->office_description);
        $office->office_details = trim($request->office_details);
        $office->created_by = $cdesk->officer_id;
        $office->modified_by = $cdesk->officer_id;
        $office->save();
    }

    public function get_office_info($office_id){
        try {
            $office_info = Office::where('id',$office_id)->get()->toArray();
	        return response(['status' => 'success', 'data' => $office_info]);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'data' => $e]);
        }
    }
}
