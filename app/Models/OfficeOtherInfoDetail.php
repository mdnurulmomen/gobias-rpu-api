<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeOtherInfoDetail extends Model
{
    use HasFactory;

    protected $table = 'office_other_info_details';
    public $timestamps = false;

    public function office_other_info_title()
    {
        return $this->belongsTo(OfficeOtherInfoTitle::class,'content_title_id','id');
    }
}
