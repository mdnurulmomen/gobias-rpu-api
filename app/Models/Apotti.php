<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apotti extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'apotti_id',
        'air_id',
        'audit_plan_id',
        'apotti_title',
        'apotti_description',
        'apotti_type',
        'onucched_no',
        'ministry_id',
        'ministry_name_en',
        'ministry_name_bn',
        'parent_office_id',
        'parent_office_name_en',
        'parent_office_name_bn',
        'fiscal_year_id',
        'fiscal_year',
        'total_jorito_ortho_poriman',
        'total_onishponno_jorito_ortho_poriman',
        'total_adjustment_ortho_poriman',
        'response_of_rpu',
        'irregularity_cause',
        'audit_conclusion',
        'audit_recommendation',
        'approve_status',
        'status',
        'comment',
        'apotti_sequence',
        'is_combined',
        'created_by',
        'updated_by',
        'file_token_no',
        'cover_page_path',
        'cover_page',
        'attachment_path',
        'report_type_id',
        'directorate_id',
        'directorate_bn',
        'directorate_en',
        'current_location'
    ];

    public function apotti_items(){
        return $this->hasMany(ApottiItem::class, 'apotti_id', 'apotti_id');
    }
}
