<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherOfficeInfo extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table ='other_office_infos';

    protected $fillable = ['office_id','office_status','date_of_formation','date_of_close','actule_strenth','office_description','office_details','office_document'];

}
