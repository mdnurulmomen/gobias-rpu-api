<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request;

interface OfficeUnitRepositoryInterface
{
    public function update(Request $request, $cdesk);
}
