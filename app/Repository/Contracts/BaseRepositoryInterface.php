<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request;

interface BaseRepositoryInterface
{
    public function store(Request $request, $cdesk);

    public function update(Request $request, $cdesk);

    public function show(Request $request);

    public function list(Request $request);

    public function delete(Request $request, $cdesk);

}
