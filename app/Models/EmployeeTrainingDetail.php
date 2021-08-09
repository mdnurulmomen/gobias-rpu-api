<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTrainingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_record_id',
        'subject',
        'lookup_id',
        'training_duration',
        'training_institute',
        'training_start_date',
        'training_end_date',
        'country_id',
        'created_by',
        'updated_by'
    ];


    public function employee(){
        return $this->belongsTo(EmployeeRecord::class,'employee_record_id', 'id');
    }

    public function audit_type(){
        return $this->belongsTo(Lookup::class,'lookup_id', 'id');
    }

    public function country(){
        return $this->belongsTo(County::class,'country_id', 'id');
    }

}
