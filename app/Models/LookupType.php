<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookupType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =['name','short_name','is_active'];

}
