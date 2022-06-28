<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apotti extends Model
{
    use HasFactory;

    public function apotti_items(){
        return $this->hasMany(ApottiItem::class, 'apotti_id', 'apotti_id');
    }
}
