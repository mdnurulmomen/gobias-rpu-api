<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorateMinistryMap extends Model
{
    use HasFactory;

    protected $table = 'directorate_ministry_maps';
    protected $fillable = [
        'designation_id',
        'directorate_name_bn',
        'directorate_name_en',
        'office_ministry_id',
        'created_by',
        'updated_by',
    ];

    public function ministry_list()
    {
        return $this->hasMany(OfficeMinistry::class, 'id','office_ministry_id');
    }
}
