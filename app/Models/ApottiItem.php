<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApottiItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'apotti_id',
        'apotti_item_id',
        'memo_id',
        'onucched_no',
        'memo_irregularity_type',
        'memo_irregularity_sub_type',
        'ministry_id',
        'ministry_name_en',
        'ministry_name_bn',
        'parent_office_id',
        'parent_office_name_en',
        'parent_office_name_bn',
        'cost_center_id',
        'cost_center_name_en',
        'cost_center_name_bn',
        'fiscal_year_id',
        'audit_year_start',
        'audit_year_end',
        'ac_query_potro_no',
        'ap_office_order_id',
        'audit_plan_id',
        'audit_type',
        'team_id',
        'memo_title_bn',
        'memo_description_bn',
        'memo_type',
        'memo_status',
        'jorito_ortho_poriman',
        'onishponno_jorito_ortho_poriman',
        'adjustment_ortho_poriman',
        'response_of_rpu',
        'irregularity_cause',
        'audit_conclusion',
        'audit_recommendation',
        'unit_response',
        'entity_response',
        'ministry_response',
        'directorate_response',
        'created_by',
        'updated_by',
        'status',
        'is_sent_ministry',
        'unit_response',
        'entity_response',
        'ministry_response',
        'directorate_response',
        'directorate_id',
        'directorate_bn',
        'directorate_en',
    ];
}
