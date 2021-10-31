<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiscal_year_id',
        'fiscal_year',
        'activity_id',
        'audit_plan',
        'office_order_id',
        'team_id',
        'team_leader_name_en',
        'team_leader_name_bn',
        'cost_center_type_id',
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
        'querier_designation_en',
        'querier_designation_bn',
        'query_receiver_officer_id',
        'query_receiver_designation_id',
        'querier_receiver_officer_name_en',
        'querier_receiver_officer_name_bn',
        'status',
    ];

    public function setQueryDateAttribute($value)
    {
        if (strstr($value, '/')){
            $value = str_replace('/','-',$value);
        }

        $this->attributes['query_date'] = Carbon::parse($value)->format('Y-m-d');
    }
}
