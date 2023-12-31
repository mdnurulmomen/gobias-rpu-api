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

    public function directorate_ministry()
    {
        return $this->belongsTo(OfficeMinistry::class, 'office_ministry_id', 'id');
    }
}
