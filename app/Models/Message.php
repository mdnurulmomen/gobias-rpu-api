<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Message extends Model
{
	protected $connection = 'mysql2';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'message_by', 'id');
    // }

    public static function userName($id){

       $username = DB::table('users')
    	->select('username')
    	->where('id',$id)
    	->first();
    	return $username->username;
    }
}
