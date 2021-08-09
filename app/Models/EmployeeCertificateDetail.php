<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCertificateDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_record_id',
        'lookup_id',
        'institute_name',
        'achievement_year',
        'certificate_file_name',
        'description',
        'country_id',
        'created_by',
        'updated_by'
    ];


    public function employee(){
        return $this->belongsTo(EmployeeRecord::class,'employee_record_id', 'id');
    }

    public function certificate_name(){
        return $this->belongsTo(Lookup::class,'lookup_id', 'id');
    }

    public function country(){
        return $this->belongsTo(County::class,'country_id', 'id');
    }

}
