<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\SendNotification;
use App\Models\AuditQuery;

class AuditQueryService
{
    use SendNotification;

    public function store(Request $request): array
    {
        try {
            $queries = $request->query_list;
            foreach ($queries as $key => $query) {
                $ac_query = new AuditQuery;
                $ac_query->audit_plan = $query['audit_plan_id'];
                $ac_query->office_order_id = $query['office_order_id'];
                $ac_query->team_id = $query['team_id'];
                $ac_query->cost_center_type_id = $query['cost_center_type_id'];
                $ac_query->ministry_id = $query['ministry_id'];
                $ac_query->controlling_office_id = $query['controlling_office_id'];
                $ac_query->controlling_office_name_en = $query['controlling_office_name_en'];
                $ac_query->controlling_office_name_bn = $query['controlling_office_name_bn'];
                $ac_query->entity_office_id = $query['entity_office_id'];
                $ac_query->entity_office_name_en = $query['entity_office_name_en'];
                $ac_query->entity_office_name_bn = $query['entity_office_name_bn'];
                $ac_query->cost_center_id = $query['cost_center_id'];
                $ac_query->cost_center_name_bn = $query['cost_center_name_bn'];
                $ac_query->cost_center_name_en = $query['cost_center_name_en'];
                $ac_query->query_id = $query['query_id'];
                $ac_query->potro_no = '1';
                $ac_query->query_title_en = $query['query_title_en'];
                $ac_query->query_title_bn = $query['query_title_bn'];
                $ac_query->query_date = $query['query_send_date'];
                $ac_query->querier_officer_id = $query['querier_officer_id'];
                $ac_query->querier_officer_name_en = $query['querier_officer_name_en'];
                $ac_query->querier_officer_name_bn = $query['querier_officer_name_en'];
                $ac_query->querier_designation_id = $query['querier_designation_id'];
                $ac_query->save();
            }

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }


    public function update(Request $request): array
    {
        //
    }


    public function show(Request $request)
    {
        //
    }

}