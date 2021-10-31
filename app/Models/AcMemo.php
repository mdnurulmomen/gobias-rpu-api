<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcMemo extends Model
{
    use HasFactory;

    protected $fillable = [
        'onucched_no',
        'memo_irregularity_type',
        'memo_irregularity_sub_type',
        'office_order_id',
        'team_id',
        'cost_center_id',
        'cost_center_name_en',
        'cost_center_name_bn',
        'fiscal_year_id',
        'fiscal_year',
        'audit_year_start',
        'audit_year_end',
        'ac_query_potro_no',
        'ap_office_order_id',
        'audit_type',
        'audit_plan_id',
        'memo_title_bn',
        'memo_description_bn',
        'memo_type',
        'memo_status',
        'memo_send_date',
        'jorito_ortho_poriman',
        'onishponno_jorito_ortho_poriman',
        'audit_conclusion',
        'audit_recommendation',
        'status',
        'sender_officer_id',
        'sender_officer_name_bn',
        'sender_officer_name_en',
        'comment',
    ];
}
