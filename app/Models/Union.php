<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table='geo_unions';

    // protected $fillable = ['district_name_bng','district_name_eng','geo_division_id','id','bbs_code','division_bbs_code','status','created_by','modified_by'];

    public function upozila()
    {
        return $this->belongsTo(UpoZila::class,'geo_upazila_id','id');
    }
}
