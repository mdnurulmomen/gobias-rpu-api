<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'offices';
    protected $fillable = [
        'geo_division_id',
        'geo_district_id',
        'office_ministry_id',
        'geo_upazila_id',
        'geo_union_id',
        'office_layer_id',
        'controlling_office_layer_id',
        'controlling_office_id',
        'custom_layer_id',
        'office_origin_id',
        'office_name_bng',
        'office_name_eng',
        'office_address',
        'office_phone',
        'office_mobile',
        'office_fax',
        'office_email',
        'office_web',
        'last_audit_year_start',
        'last_audit_year_end',
        'risk_category',
        'digital_nothi_code',
        'reference_code',
        'parent_office_id',
        'date_of_formation',
        'date_of_close',
        'office_status',
        'actual_strength',
        'office_description',
        'office_details',
        'created_by',
        'modified_by'];

    protected $appends = ['office_name_bn', 'office_name_en'];

    public function getOfficeNameBnAttribute()
    {
        return $this->office_name_bng;
    }

    public function getOfficeNameEnAttribute()
    {
        return $this->office_name_eng;
    }

    public function child()
    {
        return $this->hasMany(Office::class, 'parent_office_id', 'id')->with('child');
    }

    public function parent()
    {
        return $this->belongsTo(Office::class, 'parent_office_id', 'id')->with('parent');
    }

    public function parent_office()
    {
        return $this->belongsTo(Office::class, 'parent_office_id', 'id');
    }

    public function office_ministry()
    {
        return $this->belongsTo(OfficeMinistry::class, 'office_ministry_id', 'id');
    }

    public function controlling_office_layer()
    {
      return $this->belongsTo(OfficeLayer::class,'controlling_office_layer_id','id');
    }

    public function controlling_office()
    {
        return $this->belongsTo(Office::class, 'controlling_office_id', 'id');
    }

    public function office_layer()
    {
        return $this->belongsTo(OfficeLayer::class, 'office_layer_id', 'id');
    }

    public function office_custom_layer()
    {
        return $this->belongsTo(OfficeCustomLayer::class, 'office_id', 'id');
    }

    public function office_unit_organogram()
    {
        return $this->hasMany(OfficeUnitOrganogram::class, 'office_id', 'id')->where('status', 1);
    }

    public function office_unit_organogram_count($designation_master_id)
    {
        return $this->hasMany(OfficeUnitOrganogram::class, 'office_id', 'id')->where('status', 1)->where('ref_designation_master_info_id', $designation_master_id)
            ->count();
    }

    public function employee_office()
    {
        return $this->hasMany(EmployeeOffice::class, 'office_id', 'id')->where('status', 1);
    }

    public function office_employee_count($designation_master_id)
    {
        return $this->hasMany(EmployeeOffice::class, 'office_id', 'id')->where('status', 1)->where('ref_designation_master_info_id',
            $designation_master_id)->count();
    }

    public function rp_bn_sections()
    {
        return $this->hasMany(RpInfoSectionBn::class, 'office_id', 'id');
    }

    public function rp_en_sections()
    {
        return $this->hasMany(RpInfoSectionEn::class, 'office_id', 'id');
    }

    public function office_wise_child($childs)
    {
        $childList = [];
        foreach ($childs as $child) {
            $subChild = [];

            if (!empty($child['child'])){
                $subChild = $this->office_wise_child($child['child']);
            }

            $childList[] = [
                'id' => $child['id'],
                'office_name_bn' => $child['office_name_bn'],
                'office_name_en' => $child['office_name_en'],
                'controlling_office' =>[
                    'id' => isset($child['controlling_office'])?$child['controlling_office']['id']:"",
                    'office_name_bn' => isset($child['controlling_office'])?$child['controlling_office']['office_name_bn']:"",
                    'office_name_en' => isset($child['controlling_office'])?$child['controlling_office']['office_name_en']:"",
                ],
                'child' => $subChild
            ];
        }

        return $childList;
    }

}
