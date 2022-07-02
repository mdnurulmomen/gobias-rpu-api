<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcMemo extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'memo_id',
        'directorate_id',
        'directorate_bn',
        'directorate_en',
        'directorate_address',
        'directorate_website',
        'onucched_no',
        'memo_irregularity_type',
        'memo_irregularity_sub_type',
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
        'team_id',
        'team_leader_name',
        'team_leader_designation',
        'sub_team_leader_name',
        'sub_team_leader_designation',
        'issued_by',
        'memo_title_bn',
        'memo_description_bn',
        'irregularity_cause',
        'memo_type',
        'memo_status',
        'memo_send_date',
        'jorito_ortho_poriman',
        'onishponno_jorito_ortho_poriman',
        'response_of_rpu',
        'audit_conclusion',
        'audit_recommendation',
        'status',
        'memo_sharok_no',
        'memo_sharok_date',
        'sender_officer_id',
        'sender_officer_name_bn',
        'sender_officer_name_en',
        'sender_designation_id',
        'sender_designation_bn',
        'sender_designation_en',
        'rpu_acceptor_officer_id',
        'rpu_acceptor_officer_name_bn',
        'rpu_acceptor_officer_name_en',
        'rpu_acceptor_unit_name_bn',
        'rpu_acceptor_unit_name_en',
        'rpu_acceptor_designation_name_bn',
        'rpu_acceptor_designation_name_en',
        'comment',
        'memo_attachments',
        'memo_cc',
    ];
}
