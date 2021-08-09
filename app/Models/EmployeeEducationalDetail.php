<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducationalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_record_id',
        'lookup_id',
        'board_name',
        'institute_name',
        'subject_name',
        'passing_year',
        'created_by',
        'updated_by'
    ];

    public function employee(){
        return $this->belongsTo(EmployeeRecord::class,'employee_record_id', 'id');
    }

    public function degree(){
        return $this->belongsTo(Lookup::class,'lookup_id', 'id');
    }

}
