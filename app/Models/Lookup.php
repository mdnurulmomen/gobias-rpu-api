<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =['lookup_type_id','name','short_name','is_active'];

    public function lookup_type(){
        return $this->belongsTo(LookupType::class,'lookup_type_id', 'id');
    }

}
