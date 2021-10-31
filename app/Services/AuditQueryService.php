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
                $ac_query->directorate_id = $request->directorate_id;
                $ac_query->directorate_en = $request->directorate_en;
                $ac_query->directorate_bn = $request->directorate_bn;
                $ac_query->fiscal_year_id = $query['fiscal_year_id'];
                $ac_query->fiscal_year = $request->fiscal_year;
                $ac_query->audit_plan = $query['audit_plan_id'];
                $ac_query->office_order_id = $query['office_order_id'];
                $ac_query->team_id = $query['team_id'];
                $ac_query->team_leader_name_en = $query['team_leader_name_en'];
                $ac_query->team_leader_name_bn = $query['team_leader_name_bn'];
                $ac_query->cost_center_type_id = $query['cost_center_type_id'];
                $ac_query->cost_center_id = $query['cost_center_id'];
                $ac_query->cost_center_name_bn = $query['cost_center_name_bn'];
                $ac_query->cost_center_name_en = $query['cost_center_name_en'];
                $ac_query->query_id = $query['query_id'];
                $ac_query->potro_no = $query['potro_no'];
                $ac_query->query_title_en = $query['query_title_en'];
                $ac_query->query_title_bn = $query['query_title_bn'];
                $ac_query->query_date = $query['query_send_date'];
                $ac_query->querier_officer_id = $query['querier_officer_id'];
                $ac_query->querier_officer_name_en = $query['querier_officer_name_en'];
                $ac_query->querier_officer_name_bn = $query['querier_officer_name_bn'];
                $ac_query->querier_designation_id = $query['querier_designation_id'];
                $ac_query->querier_designation_bn = $query['querier_designation_bn'];
                $ac_query->querier_designation_en = $query['querier_designation_en'];
                $ac_query->status = $query['status'];
                $ac_query->save();
            }

            return ['status' => 'success', 'data' => 'Send Successfully'];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }


    public function update(Request $request): array
    {
        //
    }

    public function receiveQuery(Request $request): array
    {
        try {
            $ac_query = AuditQuery::where('query_id', $request->query_id)->first();
            $ac_query->query_receiver_officer_id = $request->query_receiver_officer_id;
            $ac_query->query_receiver_designation_id  = $request->query_receiver_designation_id;
            $ac_query->querier_receiver_officer_name_en= $request->querier_receiver_officer_name_en;
            $ac_query->querier_receiver_officer_name_bn = $request->querier_receiver_officer_name_bn;
            $ac_query->status = $request->status;
            $ac_query->save();

            return ['status' => 'success', 'data' => 'Remove Successfully'];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }


    public function removeQuery(Request $request): array
    {
        try {
            $ac_query = AuditQuery::where('query_id', $request->query_id)->first();
            $ac_query->query_rejector_officer_id = $request->query_rejector_officer_id;
            $ac_query->query_rejector_officer_name_en = $request->query_rejector_officer_name_en;
            $ac_query->query_rejector_officer_name_bn= $request->query_rejector_officer_name_bn;
            $ac_query->query_rejector_officer_designation_id = $request->query_rejector_officer_designation_id;
            $ac_query->comment = $request->comment;
            $ac_query->status = $request->status;
            $ac_query->save();

            return ['status' => 'success', 'data' => 'Remove Successfully'];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }



}
