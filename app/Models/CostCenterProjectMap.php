<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenterProjectMap extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'office_id',
        'office_name_bn',
        'office_name_en',
        'directorate_id',
        'ministry_id',
        'entity_id',
        'project_id',
    ];

    public function ministry()
    {
        return $this->belongsTo(OfficeMinistry::class, 'ministry_id', 'id');
    }

    public function entity()
    {
        return $this->belongsTo(Office::class, 'entity_id', 'id');
    }

    public function project(){
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function office(){
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function parent_office(){
        return $this->belongsTo(Office::class, 'parent_office_id', 'id');
    }
}
