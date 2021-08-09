<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeOriginUnit extends Model
{
    use HasFactory;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'office_origin_units';
    protected $appends = ['name_bng', 'name_eng'];
    protected $all_parent_ids = [];

    protected $fillable=['id','office_ministry_id','office_layer_id','office_origin_id','unit_name_bng','unit_name_eng','office_unit_category','parent_unit_id','unit_level','active_status','created_by','modified_by'];

    public function getNameBngAttribute()
    {
        return $this->unit_name_bng;
    }

    public function getNameEngAttribute()
    {
        return $this->unit_name_eng;
    }

    public function child()
    {
        return $this->hasMany(OfficeOriginUnit::class, 'parent_unit_id', 'id')->with('child');
    }

    public function originOrganograms()
    {
        return $this->hasMany(OfficeOriginUnitOrganogram::class, 'office_origin_unit_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(OfficeOriginUnit::class,'parent_unit_id','id')->with('parent');
    }

    public function getAllParentId() {
		$this->getAllParentIdRequcrring($this);
		return $this->all_parent_ids;
	}

	public function getAllParentIdRequcrring($origin_unit) {
		array_push($this->all_parent_ids, $origin_unit->id);
		if ($origin_unit->parent) {
			return self::getAllParentIdRequcrring($origin_unit->parent);
		}
	}
}
