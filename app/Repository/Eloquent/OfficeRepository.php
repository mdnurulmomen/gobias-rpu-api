<?php

namespace App\Repository\Eloquent;

use App\Models\Office;
use App\Models\OfficeMinistry;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class OfficeRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        $office = new Office;
        $office->directorate_id = $request->directorate_id;
        $office->office_ministry_id = $request->office_ministry_id;
        $office->office_layer_id = $request->office_layer_id;
        $office->custom_layer_id = $request->office_layer_id;
        $office->parent_office_layer_id = $request->parent_office_layer_id;
        $office->parent_office_id = $request->parent_office_id;
        $office->office_type = $request->office_type;
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
        $office->last_audit_year_start = $request->last_audit_year_start;
        $office->last_audit_year_end = $request->last_audit_year_end;
        $office->risk_category = $request->risk_category;
        $office->date_of_formation = empty($request->date_of_formation) ? null : date('Y-m-d', strtotime($request->date_of_formation));
        $office->date_of_close = empty($request->date_of_close) ? null : date('Y-m-d', strtotime($request->date_of_close));
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

    public function show($officeId)
    {
        /*$result = array();
        $rpSections = array();

        $officeInfo = Office::with(['rp_bn_sections','rp_en_sections'])
            ->where('id',$officeId)->first();

        //dd($officeInfo->rp_bn_sections);
        foreach ($officeInfo->rp_bn_sections as $bnSections){
            $rpSections[$bnSections->seq_no][] = array(
                'info_type_bn' => $bnSections->info_type,
                'info_section_data_bn' => $bnSections->info_section_data,
            );
        }

        foreach ($officeInfo->rp_en_sections as $enSections){
            $rpSections[$enSections->seq_no][] = array(
                'info_type_en' => $enSections->info_type,
                'info_section_data_en' => $enSections->info_section_data,
            );
        }

        unset($officeInfo->rp_bn_sections,$officeInfo->rp_en_sections);
        $result['office_info'] =$officeInfo;

        return $rpSections;*/
        /*return Office::with(['rp_bn_sections','rp_en_sections'])
            ->where('id',$officeId)->first()->toArray();*/

        $response = array();
        $response['office_info'] = Office::where('id', $officeId)->first();
        $response['section_list'] = \DB::table('rp_info_section_bn as section_bn')
            ->leftJoin('rp_info_section_en as section_en', 'section_bn.id', '=', 'section_en.section_bn_id')
            ->where('section_bn.office_id', $officeId)
            ->get(
                [
                    'section_bn.id',
                    'section_bn.info_type',
                    'section_bn.rp_info_section_id',
                    'section_bn.info_section_data as section_data_bn',
                    'section_en.info_section_data as section_data_en',
                ]
            );

        return $response;

    }

    public function update(Request $request, $cdesk)
    {
        $office = Office::find($request->id);
        $office->directorate_id = $request->directorate_id;
        $office->office_ministry_id = $request->office_ministry_id;
        $office->office_layer_id = $request->office_layer_id;
        $office->custom_layer_id = $request->office_layer_id;
        $office->parent_office_layer_id = $request->parent_office_layer_id;
        $office->parent_office_id = $request->parent_office_id;
        $office->office_type = $request->office_type;
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
        $office->last_audit_year_start = $request->last_audit_year_start;
        $office->last_audit_year_end = $request->last_audit_year_end;
        $office->risk_category = $request->risk_category;
        $office->date_of_formation = empty($request->date_of_formation) ? null : date('Y-m-d', strtotime($request->date_of_formation));
        $office->date_of_close = empty($request->date_of_close) ? null : date('Y-m-d', strtotime($request->date_of_close));
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

        $office_ministry_id = $request->office_ministry_id;
        $office_layer_id = $request->office_layer_id;
        $custom_layer_id = $request->custom_layer_id;
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
            return $q->where('office_name_bng', 'LIKE', "%{$office_name_bng}%");
        });

        $query->when($office_name_eng, function ($q, $office_name_eng) {
            return $q->where('office_name_eng', 'LIKE', "%{$office_name_eng}%");
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
        $offices = Office::with(['child.controlling_office', 'controlling_office'])
            ->where('office_ministry_id', $request->office_ministry_id)
            ->where('office_layer_id', $request->office_layer_id)
            ->get()
            ->toArray();

        $ministry = OfficeMinistry::find($request->office_ministry_id, ['name_eng', 'name_bng', 'id'])->toArray();

        $controlling_office_data = [];
        foreach ($offices as $office) {
            $controlling_office = $office['controlling_office'] == null ? Office::where('id', $office['id'])->first() : $office['controlling_office'];
            $controllingOfficeId = $controlling_office['id'];
            $controllingOfficeNameBn = $controlling_office['office_name_bn'];
            $controllingOfficeNameEn = $controlling_office['office_name_en'];

            $child = (new \App\Models\Office)->office_wise_child($office['child']);
            $office_data[] = [
                'id' => $office['id'],
                'office_name_bn' => $office['office_name_bn'],
                'office_name_en' => $office['office_name_en'],
                'child' => $child,
            ];
            $controlling_office_data['offices'][$controllingOfficeId] = [
                'controlling_office_id' => $controllingOfficeId,
                'controlling_office_name_bn' => $controllingOfficeNameBn,
                'controlling_office_name_en' => $controllingOfficeNameEn,
                'rp_offices' => $office_data,
            ];
        }
        $data = ['office_ministry' => $ministry] + $controlling_office_data;
        return $data;
    }

    public function get_office_parent_wise(Request $request)
    {
        $offices = Office::with(['office_ministry', 'child.controlling_office', 'controlling_office'])
            ->where('parent_office_id', $request->parent_office_id)
            ->get()
            ->toArray();

        foreach ($offices as $office) {
            if ($office['controlling_office'] == null) {
                $controllingOffice = Office::where('id', $office['id'])->first();
                $controllingOfficeId = $controllingOffice['id'];
                $controllingOfficeNameBn = $controllingOffice['office_name_bn'];
                $controllingOfficeNameEn = $controllingOffice['office_name_en'];
            } else {
                $controllingOfficeId = $office['controlling_office']['id'];
                $controllingOfficeNameBn = $office['controlling_office']['office_name_bn'];
                $controllingOfficeNameEn = $office['controlling_office']['office_name_en'];
            }
            $child = (new \App\Models\Office)->office_wise_child($office['child']);
            $response = [
                [
                    'id' => $office['id'],
                    'office_name_bn' => $office['office_name_bn'],
                    'office_name_en' => $office['office_name_en'],
                    'office_ministry' => [
                        'id' => $office['office_ministry']['id'],
                        'name_eng' => $office['office_ministry']['name_eng'],
                        'name_bng' => $office['office_ministry']['name_bng'],
                    ],
                    'child' => $child,
                    'controlling_office' => [
                        'id' => $controllingOfficeId,
                        'office_name_bn' => $controllingOfficeNameBn,
                        'office_name_en' => $controllingOfficeNameEn,
                    ],
                ],
            ];


        }
        return $response;
    }

    //for office datatable
    public function officeDatatable(Request $request)
    {
        $limit = $request->length;
        $start = $request->start;
        $order = $request->order;
        $dir = $request->dir;

        if (empty($request->search)) {
            $totalData = Office::count();
            $offices = Office::with(['parent_office', 'office_ministry', 'office_layer', 'controlling_office_layer', 'controlling_office'])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->search;

            $commonSql = Office::with(['parent_office', 'office_ministry', 'office_layer', 'controlling_office_layer', 'controlling_office'])
                ->where('office_name_eng', 'like', '%' . $search . '%')
                ->orWhere('office_name_bng', 'LIKE', "%{$search}%")
                ->orWhere('office_email', 'LIKE', "%{$search}%")
                ->orWhere('office_web', 'LIKE', "%{$search}%");

            $totalData = $commonSql->count();
            $offices = $commonSql->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

        $response = array(
            "offices" => $offices,
            "totalData" => $totalData,
            "totalFiltered" => $totalData,
        );
        return $response;
    }

    public function getRupListMis(Request $request)
    {
        $directorate_id  = $request->directorate_id;
        $office_ministry_id  = $request->office_ministry_id;
        $risk_category  = $request->risk_category;
        $audit_year  = $request->audit_due_year;

        $query = Office::query();

        $query->when($directorate_id, function ($q, $directorate_id) {
            return $q->where('directorate_id', $directorate_id);
        });

        $query->when($office_ministry_id, function ($q, $office_ministry_id) {
            return $q->where('office_ministry_id', $office_ministry_id);
        });

        $query->when($risk_category, function ($q, $risk_category) {
            return $q->where('risk_category', $risk_category);
        });

        $query->when($audit_year, function ($q, $audit_year) {
            return $q->where('last_audit_year_start', $audit_year);
        });

        return $query->with('office_ministry','controlling_office','office_layer','parent_office')->limit(20)->get()->toArray();
    }
}
