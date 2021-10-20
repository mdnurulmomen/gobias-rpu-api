<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiscal_year_id',
        'activity_id',
        'annual_plan_id',
        'audit_plan_id',
        'office_order_id',
        'team_id',
        'team_leader_name_en',
        'team_leader_name_bn',
        'cost_center_type_id',
        'ministry_id',
        'controlling_office_id',
        'controlling_office_name_en',
        'controlling_office_name_bn',
        'entity_office_id',
        'entity_office_name_en',
        'entity_office_name_bn',
        'cost_center_id',
        'cost_center_name_en',
        'cost_center_name_bn',
        'potro_no',
        'query_id',
        'query_title_en',
        'query_title_bn',
        'query_date',
        'query_document_date',
        'querier_officer_id',
        'querier_officer_name_en',
        'querier_officer_name_bn',
        'querier_designation_id',
        'query_receiver_officer_id',
        'query_receiver_designation_id',
        'querier_receiver_officer_name_en',
        'querier_receiver_officer_name_bn',
        'status',
    ];
}
