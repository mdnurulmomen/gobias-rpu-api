<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoDistrict extends Model
{
    use HasFactory;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table='geo_districts';

    protected $fillable = ['district_name_bng','district_name_eng','geo_division_id',
        'bbs_code','division_bbs_code','status','created_by','modified_by'];

    public function division()
    {
        return $this->belongsTo(GeoDivision::class,'geo_division_id','id');
    }
}
