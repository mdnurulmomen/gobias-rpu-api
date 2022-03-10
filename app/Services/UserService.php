<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function list(Request $request){
        try {
            $user_id = $request->user_id;
            $user_role_id = $request->user_role_id;

            $query = User::query();

            $query->when($user_id, function ($q, $user_id) {
                return $q->where('id', $user_id);
            });

            $query->when($user_role_id, function ($q, $user_role_id) {
                return $q->where('user_role_id', $user_role_id);
            });

            $userList = $query->get();

            return ['status' => 'success', 'data' => $userList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
