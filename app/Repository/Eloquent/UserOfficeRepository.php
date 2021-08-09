<?php

namespace App\Repository\Eloquent;

use App\Models\UserOffice;
use App\Repository\Contracts\UserOfficeRepositoryInterface;

class UserOfficeRepository implements UserOfficeRepositoryInterface
{

    public function create($user, $office, $cdesk)
    {
        $userOffice = new UserOffice();
        $userOffice->user_id = 1;
        $userOffice->office_id = 1;
        $userOffice->office_name_bn = 'df';
        $userOffice->office_name_en = 'asdf';
        $userOffice->status = 1;
        $userOffice->created_by = $cdesk->officer_id;
        $userOffice->save();
    }
}
