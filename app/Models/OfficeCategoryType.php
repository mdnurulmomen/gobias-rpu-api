<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeCategoryType extends Model
{
    protected $fillable = [
        'category_title_en',
        'category_title_bn',
        'status',
    ];
}
