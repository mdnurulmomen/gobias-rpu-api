<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeUnit extends Model
{
    use HasFactory;

    protected $table = 'office_units';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable=[
		'id',
		'office_ministry_id',
		'office_layer_id',
		'office_id',
		'office_origin_unit_id',
		'unit_name_bng',
		'unit_name_eng',
		'office_unit_category',
		'parent_unit_id',
		'parent_origin_unit_id',
		'unit_nothi_code',
		'unit_level',
		'sarok_no_start',
		'email',
		'phone',
		'fax',
		'active_status',
		'created_by',
		'modified_by',
	];

    protected $appends = ['name_bng', 'name_eng'];
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
        return $this->hasMany(OfficeUnit::class, 'parent_unit_id', 'id')->with('child');
    }

    public function parent()
    {
        return $this->belongsTo(OfficeUnit::class,'parent_unit_id','id')->with('parent');
    }

    public function organograms()
    {
        return $this->hasMany(OfficeUnitOrganogram::class,'office_unit_id','id');
    }

	public function office_unit_origin()
	{
		return $this->belongsTo(OfficeOriginUnit::class,'office_origin_unit_id','id');
	}

	public function originOrganograms()
	{
		return $this->office_unit_origin->originOrganograms();
	}

	public function office_info() {
		return $this->belongsTo(Office::class, 'office_id');
	}

}
