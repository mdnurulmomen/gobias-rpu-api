<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeOrigin extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'office_origins';
    protected $fillable = [
        'office_ministry_id',
        'office_layer_id',
        'office_name_eng',
        'office_name_bng',
        'parent_office_id',
        'office_level',
        'office_sequence',
        'active_status',
        'created_by',
        'modified_by',
    ];
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
        return $this->hasMany(OfficeOrigin::class, 'parent_office_id', 'id')->with('child');
    }

    public function office_ministry()
    {
        return $this->belongsTo(OfficeMinistry::class, 'office_ministry_id', 'id');
    }

    public function office_layer()
    {
        return $this->belongsTo(OfficeLayer::class, 'office_layer_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(OfficeOrigin::class, 'parent_office_id', 'id')->with('parent');
    }
}
