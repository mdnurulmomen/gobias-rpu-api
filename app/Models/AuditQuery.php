<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'directorate_id',
        'directorate_en',
        'directorate_bn',
        'fiscal_year_id',
        'fiscal_year',
        'audit_plan_id',
        'office_order_id',
        'team_id',
        'team_name_bn',
        'team_name_en',
        'team_leader_name_en',
        'team_leader_name_bn',
        'team_leader_role',
        'cost_center_id',
        'cost_center_name_en',
        'cost_center_name_bn',
        'query_id',
        'query_date',
        'query_items',
        'querier_officer_id',
        'querier_officer_name_en',
        'querier_officer_name_bn',
        'querier_designation_id',
        'querier_designation_bn',
        'querier_designation_en',
        'query_receiver_officer_id',
        'query_receiver_designation_id',
        'querier_receiver_officer_name_en',
        'querier_receiver_officer_name_bn',
        'rpu_office_head_details',
        'memorandum_no',
        'memorandum_date',
        'subject',
        'description',
        'cc',
        'comment',
        'status'
    ];

    /*public function setQueryDateAttribute($value)
    {
        if (strstr($value, '/')){
            $value = str_replace('/','-',$value);
        }

        $this->attributes['query_date'] = Carbon::parse($value)->format('Y-m-d');
    }*/

    public function getMemorandumDateAttribute($value): string
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setMemorandumDateAttribute($value)
    {
        if (strstr($value, '/')){
            $value = str_replace('/','-',$value);
        }
        $this->attributes['memorandum_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function audit_query_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AuditQueryItem::class, 'query_id', 'id');
    }
}
