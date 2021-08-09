<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOffice extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'employee_offices';
    protected $fillable = ['employee_record_id', 'identification_number', 'office_id', 'office_unit_id', 'office_unit_organogram_id', 'designation', 'designation_level', 'designation_sequence', 'is_default_role', 'office_head', 'is_admin', 'summary_nothi_post_type', 'incharge_label', 'main_role_id', 'joining_date', 'last_office_date', 'status', 'status_change_date', 'show_unit', 'designation_en', 'unit_name_bn','protikolpo_status', 'office_name_bn', 'unit_name_en', 'office_name_en', 'created_by', 'modified_by'];

    public function employee_record()
    {
        return $this->belongsTo(EmployeeRecord::class, 'employee_record_id', 'id');
    }

    public function office_unit()
    {
        return $this->belongsTo(OfficeUnit::class, 'office_unit_id','id');
    }

    public function office_info(){
        return $this->belongsTo(Office::class, 'office_id','id');
    }

}
