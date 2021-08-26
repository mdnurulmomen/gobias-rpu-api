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
        $office->parent_office_layer_id = $request->parent_office_layer_id;
        $office->parent_office_id = $request->parent_office_id;
        $office->controlling_office_layer_id = $request->controlling_office_layer_id;
        $office->controlling_office_id = $request->controlling_office_id;
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
        $office->controlling_office_layer_id = $request->controlling_office_layer_id;
        $office->controlling_office_id = $request->controlling_office_id;
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
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    public function list(Request $request)
    {
        // TODO: Implement list() method.
    }

    public function searchOffice(Request $request)
    {

        $office_ministry_id  = $request->office_ministry_id;
        $office_layer_id  = $request->office_layer_id;
        $custom_layer_id  = $request->custom_layer_id;
        $office_name_bng = $request->office_name_bng;
        $office_name_eng = $request->office_name_eng;
        $geo_division_id = $request->geo_division_id;
        $geo_district_id = $request->geo_district_id;
        $geo_upazila_id = $request->geo_upazila_id;
        $geo_union_id = $request->geo_union_id;
        $office_code = $request->office_code;
        $office_phone = $request->office_phone;
        $office_email = $request->office_email;
        $office_web = $request->office_web;
        $parent_office_id = $request->parent_office_id;
        $active_status = $request->active_status;

        $query = Office::query();

        $query->when($office_ministry_id, function ($q, $office_ministry_id) {
            return $q->where('office_ministry_id', $office_ministry_id);
        });

        $query->when($office_layer_id, function ($q, $office_layer_id) {
            return $q->where('office_layer_id', $office_layer_id);
        });

        $query->when($custom_layer_id, function ($q, $custom_layer_id) {
            return $q->where('custom_layer_id', $custom_layer_id);
        });

        $query->when($office_name_bng, function ($q, $office_name_bng) {
            return $q->where('office_name_bng', 'LIKE',"%{$office_name_bng}%");
        });

        $query->when($office_name_eng, function ($q, $office_name_eng) {
            return $q->where('office_name_eng', 'LIKE',"%{$office_name_eng}%");
        });

        $query->when($geo_division_id, function ($q, $geo_division_id) {
            return $q->where('geo_division_id', $geo_division_id);
        });

        $query->when($geo_district_id, function ($q, $geo_district_id) {
            return $q->where('geo_district_id', $geo_district_id);
        });

        $query->when($geo_upazila_id, function ($q, $geo_upazila_id) {
            return $q->where('geo_upazila_id', $geo_upazila_id);
        });

        $query->when($geo_union_id, function ($q, $geo_union_id) {
            return $q->where('geo_union_id', $geo_union_id);
        });

        $query->when($office_code, function ($q, $office_code) {
            return $q->where('office_code', $office_code);
        });

        $query->when($office_phone, function ($q, $office_phone) {
            return $q->where('office_phone', $office_phone);
        });

        $query->when($office_email, function ($q, $office_email) {
            return $q->where('office_email', $office_email);
        });

        $query->when($office_web, function ($q, $office_web) {
            return $q->where('office_web', $office_web);
        });

        $query->when($parent_office_id, function ($q, $parent_office_id) {
            return $q->where('parent_office_id', $parent_office_id);
        });

        $query->when($active_status, function ($q, $status) {
            return $q->where('active_status', $status);
        });

        return $query->get()->toArray();
    }

    public function getCostCenterOffice(Request $request)
    {
        $office_ministry_id = $request->office_ministry_id;
        $office_layer_id = $request->cost_center_layer_id;
        $parent_office_id = $request->parent_office_id;

        $query = Office::query();

        $query->when($office_ministry_id, function ($q, $office_ministry_id) {
            return $q->where('office_ministry_id', $office_ministry_id);
        });

        $query->when($office_layer_id, function ($q, $office_layer_id) {
            return $q->where('office_layer_id', $office_layer_id);
        });

        $query->when($parent_office_id, function ($q, $parent_office_id) {
            return $q->where('parent_office_id', $parent_office_id);
        });

        return $query->get()->toArray();
    }

    public function get_office_ministry_and_layer_wise(Request $request)
    {
        return Office::with(['office_ministry','parent','child'])->select('id','office_name_eng','office_name_bng','office_name_eng AS office_name_en','office_name_bng AS office_name_bn')->where('office_ministry_id',$request->office_ministry_id)
            ->where('office_layer_id',$request->office_layer_id)->get()->toArray();
    }

    //for office datatable
    public function officeDatatable(Request $request){
        $limit = $request->length;
        $start = $request->start;
        $order = $request->order;
        $dir = $request->dir;

        if (empty($request->search)) {
            $totalData = Office::count();
            $offices = Office::with(['parent_office','office_ministry','office_layer','controlling_office_layer','controlling_office'])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

        else {
            $search = $request->search;

            $commonSql = Office::with(['parent_office','office_ministry','office_layer'])
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
}
