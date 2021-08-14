<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsibleParty extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table ='responsible_parties';

    protected $fillable = ['office_ministry_id','controlling_office_layer_id','controlling_office_id','parent_office_layer_id','parent_office_id','cost_center_layer_id','cost_center_id','cost_center_type','created_by','modified_by'];

    public function office_ministry()
    {
      return $this->belongsTo(OfficeMinistry::class,'office_ministry_id','id');
    }

    public function controlling_office_layer()
    {
      return $this->belongsTo(OfficeLayer::class,'controlling_office_layer_id','id');
    }

    public function cost_center_layer()
    {
      return $this->belongsTo(OfficeLayer::class,'cost_center_layer_id','id');
    }

    public function parent_office_layer()
    {
      return $this->belongsTo(OfficeLayer::class,'parent_office_layer_id','parent_layer_id')->with('parent_office_layer');
    }

    public function controlling_office()
    {
        return $this->belongsTo(OfficeOrigin::class, 'controlling_office_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(OfficeOrigin::class,'parent_office_id','id')->with('parent');
    }

    public function cost_center()
    {
        return $this->belongsTo(OfficeOrigin::class, 'cost_center_id', 'id');
    }


}
