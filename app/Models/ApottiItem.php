<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApottiItem extends Model
{
    use HasFactory,SoftDeletes;

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
        'fiscal_year',
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
        'collected_amount',
        'response_of_rpu',
        'irregularity_cause',
        'audit_conclusion',
        'audit_recommendation',
        'ministry_office_id',
        'unit_response',
        'entity_response',
        'ministry_response',
        'directorate_response',
        'created_by',
        'updated_by',
        'status',
        'file_token_no',
        'cover_page_path',
        'cover_page',
        'attachment_path',
        'report_type_id',
        'is_sent_ministry',
        'directorate_id',
        'directorate_bn',
        'directorate_en',
        'is_response_unit',
        'is_response_entity',
        'is_response_ministry',
        'is_sent_amms',
        'is_response_amms',
        'current_location'
    ];

    public function apotti_attachements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AcMemoAttachment::class,'ac_memo_id','memo_id');
    }
}
