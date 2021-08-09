<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OfficeUnitOrganogram extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'id',
        'office_id',
        'office_unit_id',
        'superior_unit_id',
        'superior_designation_id',
        'ref_origin_unit_org_id',
        'ref_sup_origin_unit_desig_id',
        'ref_sup_origin_unit_id',
        'ref_designation_master_info_id',
        'designation_eng',
        'designation_bng',
        'short_name_eng',
        'short_name_bng',
        'designation_level',
        'ref_designation_grade',
        'designation_sequence',
        'designation_description',
        'status',
        'is_admin',
        'is_unit_admin',
        'is_unit_head',
        'is_office_head',
        'created_by',
        'modified_by',
        'created',
        'modified',
    ];
    protected $appends = ['name_bng', 'name_eng'];

    public static function getSuperiorDesignationId($final_data, $superior_origin_unit_desig_id)
    {
        $superior_data = array();
        foreach ($final_data as $struct) {
            if ($superior_origin_unit_desig_id == $struct->ref_sup_origin_unit_desig_id) {
                $superior_data['designation'] = $struct->id;
                $superior_data['unit'] = $struct->office_unit_id;
                break;
            }
        }
        return $superior_data;
    }

    public function assigned_user()
    {
        return $this->hasOne(EmployeeOffice::class, 'office_unit_organogram_id', 'id')->where('status', 1);
    }

    public function employee_offices()
    {
        return $this->hasMany(EmployeeOffice::class, 'office_unit_organogram_id', 'id');
    }

    public function assigned_user2()
    {
        return EmployeeOffice::where('office_unit_organogram_id', $this->id)->where('status', 1)->first();
    }

    public function assigned_front_desk()
    {
        return $this->hasOne(OfficeFrontDesk::class, 'office_unit_organogram_id', 'id');
    }

    public function getNameBngAttribute()
    {
        return $this->designation_bng;
    }

    public function getNameEngAttribute()
    {
        return $this->designation_eng;
    }

    public function office_info()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }


    public function officeEmployee()
    {
        $id = EmployeeOffice::where('office_unit_organogram_id', $this->id)->where('status', 1)->first();
        if ($id)
            return EmployeeRecord::where('id', $id->employee_record_id)->first();
        else
            return false;
    }

    public function office_unit()
    {
        return $this->belongsTo(OfficeUnit::class, 'office_unit_id');
    }
}
