<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        $user = new User();
        $user->username = trim($request->office_web);
        $user->email = trim($request->office_email);
        $user->password = Hash::make('123456');
        $user->user_alias = trim($request->office_web);
        $user->active = 1;
        $user->user_role_id = 3;
        $user->is_admin = 1;
        $user->user_status = 1;
        $user->modified_by = $cdesk->user_primary_id;
        $user->is_email_verified = 0;
        $user->force_password_change = 1;
        $user->created_by = $cdesk->user_primary_id;
        $user->save();

        $lastInsertId = $user->id;
        return $lastInsertId;

    }

    public function update(Request $request, $cdesk)
    {
        // TODO: Implement update() method.
    }

    public function show(Request $request)
    {
        // TODO: Implement show() method.
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    public function list(Request $request)
    {
        // TODO: Implement list() method.
    }
}
