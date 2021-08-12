<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request;

interface UserOfficeRepositoryInterface
{
    public function create(Request $request, $user, $office, $cdesk);
}
