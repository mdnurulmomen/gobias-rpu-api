<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RAir extends Model
{
    use HasFactory;

    protected $fillable = [
        'air_id',
        'cost_center_id',
        'report_number',
        'report_name',
        'fiscal_year_id',
        'fiscal_year',
        'annual_plan_id',
        'audit_plan_id',
        'activity_id',
        'air_description',
        'directorate_id',
        'directorate_bn',
        'directorate_en',
        'sender_id',
        'sender_name_en',
        'sender_name_bn',
        'send_date',
        'last_date_of_reply',
        'is_received',
    ];
}
