<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Traits\SendNotification;
use App\Models\AuditQuery;

class AuditQueryService
{
    use SendNotification;

    public function store(Request $request): array
    {
        try {
            //get ac query
            $ac_query = $request->ac_query;

            //audit query
            $auditQuery = new AuditQuery;
            $auditQuery->directorate_id = $request->directorate_id;
            $auditQuery->directorate_en = $request->directorate_en;
            $auditQuery->directorate_bn = $request->directorate_bn;

            $auditQuery->fiscal_year_id = $ac_query['fiscal_year_id'];
            $auditQuery->fiscal_year = $request->fiscal_year;
            $auditQuery->audit_plan_id = $ac_query['audit_plan_id'];
            $auditQuery->office_order_id = $ac_query['office_order_id'];

            $auditQuery->team_id = $ac_query['team_id'];
            $auditQuery->team_name_bn = $ac_query['plan_team']['team_name'];
            $auditQuery->team_name_en = $ac_query['plan_team']['team_name'];
            $auditQuery->team_leader_name_en = $ac_query['plan_team']['leader_name_en'];
            $auditQuery->team_leader_name_bn = $ac_query['plan_team']['leader_name_bn'];
            $auditQuery->team_leader_role = $ac_query['plan_team']['team_parent_id'] ==0?'দলনেতা':'উপ দলনেতা';

            $auditQuery->cost_center_id = $ac_query['cost_center_id'];
            $auditQuery->cost_center_name_en = $ac_query['cost_center_name_en'];
            $auditQuery->cost_center_name_bn = $ac_query['cost_center_name_bn'];
            $auditQuery->query_id = $ac_query['id'];
            $auditQuery->query_date = date('Y-m-d',strtotime($ac_query['created_at']));
            $auditQuery->query_items = $request->ac_query_items;
            $auditQuery->querier_officer_id = $ac_query['querier_officer_id'];
            $auditQuery->querier_officer_name_en = $ac_query['querier_officer_name_en'];
            $auditQuery->querier_officer_name_bn = $ac_query['querier_officer_name_bn'];
            $auditQuery->querier_designation_id = $ac_query['querier_designation_id'];
            $auditQuery->querier_designation_bn = $ac_query['querier_designation_bn'];
            $auditQuery->querier_designation_en = $ac_query['querier_designation_en'];
            $auditQuery->rpu_office_head_details = $ac_query['rpu_office_head_details'];
            $auditQuery->memorandum_no = $ac_query['memorandum_no'];
            $auditQuery->memorandum_date = $ac_query['memorandum_date'];
            $auditQuery->subject = $ac_query['subject'];
            $auditQuery->description = $ac_query['description'];
            $auditQuery->cc = $ac_query['cc'];
            $auditQuery->comment = $ac_query['comment'];
            $auditQuery->status = $ac_query['status'];
            $auditQuery->save();

            return ['status' => 'success', 'data' => 'Send Successfully'];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }



    public function receiveQuery(Request $request): array
    {
        try {
            $auditQuery = AuditQuery::where('query_id', $request->ac_query_id)->first();
            $auditQuery->query_items = $request->ac_query_items;
            $auditQuery->save();
            return ['status' => 'success', 'data' => 'Received Successfully'];

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
