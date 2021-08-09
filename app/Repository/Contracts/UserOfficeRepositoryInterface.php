<?php

namespace App\Repository\Contracts;

interface UserOfficeRepositoryInterface
{
    public function create($user, $office, $cdesk);
}
