<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOffice extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'user_offices';
    protected $fillable = ['user_id', 'office_id', 'joining_date', 'status', 'office_name_bn', 'office_name_en', 'created_by', 'modified_by'];

    public function user_inof()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function office_info(){
        return $this->belongsTo(Office::class, 'office_id','id');
    }

}
