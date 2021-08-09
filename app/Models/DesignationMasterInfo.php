<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationMasterInfo extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'designation_master_info';

    protected $fillable = [
        'designation_name_eng',
        'designation_name_bng',
        'designation_grade',
        'status'
    ];

    public function office_unit_organogram(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OfficeUnitOrganogram::class, 'ref_designation_master_info_id', 'id');
    }

}
