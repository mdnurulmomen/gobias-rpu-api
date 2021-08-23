<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RpInfoSectionEn extends Model
{
    use HasFactory;

    protected $table='rp_info_section_en';
    protected $fillable=[
		'id',
		'info_year_id',
		'rp_id',
		'rp_info_section_id',
		'info_type',
		'info_section_data',
		'seq_no',
	];
}
