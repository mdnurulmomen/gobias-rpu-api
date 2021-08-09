<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function create(Request $request, $cdesk)
    {
        $user = new User();
        $user->username = $request->office_web;
        $user->password = Hash::make('123456');
        $user->user_alias = $request->office_web;
        $user->active = 1;
        $user->user_role_id = 3;
        $user->is_admin = 1;
        $user->user_status = 1;
        $user->modified_by = $cdesk->officer_id;
        $user->is_email_verified = 0;
        $user->force_password_change = 0;
        $user->created_by = $cdesk->officer_id;
        $user->save();
    }
}
