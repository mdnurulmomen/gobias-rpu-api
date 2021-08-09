<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request;

interface OfficeRepositoryInterface
{
    public function create(Request $request, $cdesk);
}
