<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeOriginUnitOrganogram extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'office_origin_unit_organograms';
    protected $appends = ['name_bng', 'name_eng'];
    protected $fillable = ['office_origin_unit_id', 'superior_unit_id', 'superior_designation_id','designation_master_info_id','designation_grade','designation_eng', 'designation_bng', 'short_name_eng', 'short_name_bng', 'designation_level', 'designation_sequence', 'status', 'created_by', 'modified_by'];

    public function getNameBngAttribute()
    {
        return $this->designation_bng;
    }

    public function getNameEngAttribute()
    {
        return $this->designation_eng;
    }
    //
    //    public function child()
    //    {
    //        return $this->hasMany(OfficeLayer::class, 'parent_layer_id', 'id')->with('child');
    //    }
}
