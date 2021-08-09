<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonorBoard extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table ='honor_boards';

    protected $fillable = ['unit_id','name','organogram_name','incharge_label','join_date','release_date','id','employee_record_id','organogram_id','created','modified'];
}
