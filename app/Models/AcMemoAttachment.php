<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcMemoAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ac_memo_id',
        'directorate_id',
        'directorate_bn',
        'directorate_en',
        'file_type',
        'file_user_define_name',
        'file_custom_name',
        'file_dir',
        'file_path',
        'file_size',
        'file_extension',
        'sequence',
        'created_by',
        'modified_by',
        'deleted_by',
    ];
}
