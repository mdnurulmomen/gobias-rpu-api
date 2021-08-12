<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request;

interface UserOfficeRepositoryInterface
{
    public function storeUserOffice(Request $request, $user, $office, $cdesk);
}
