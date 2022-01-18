<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditQueryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'query_id',
        'item_title_en',
        'item_title_bn',
        'status',
        'comment',
        'created_by',
        'updated_by',
    ];
}
