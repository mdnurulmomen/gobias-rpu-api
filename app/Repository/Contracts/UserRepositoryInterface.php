<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function create(Request $request, $cdesk);
}
