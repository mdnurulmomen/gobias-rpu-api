<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    use HasFactory;

    public function child()
    {
        return $this->hasMany(CostCenter::class, 'parent_office_id', 'office_id')->with('child');
    }

    public function parent()
    {
        return $this->belongsTo(CostCenter::class, 'parent_office_id', 'office_id')->with('parent');
    }

    public function parent_with_office()
    {
        return $this->belongsTo(CostCenter::class, 'parent_office_id', 'office_id')->with('parent.office:id,office_name_bng,office_name_eng','office:id,office_name_bng,office_name_eng');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function office_layer()
    {
        return $this->belongsTo(OfficeLayer::class, 'office_layer_id', 'id');
    }

    public function office_ministry()
    {
        return $this->belongsTo(OfficeMinistry::class, 'office_ministry_id', 'id');
    }
}
