<?php

namespace App\Repository\Eloquent;

use App\Models\UserOffice;
use App\Repository\Contracts\UserOfficeRepositoryInterface;
use Illuminate\Http\Request;

class UserOfficeRepository implements UserOfficeRepositoryInterface
{

    public function storeUserOffice(Request $request, $userId, $officeId, $cdesk)
    {
        $userOffice = new UserOffice();
        $userOffice->user_id = $userId;
        $userOffice->office_id = $officeId;
        $userOffice->office_name_bn = $request->office_name_eng;
        $userOffice->office_name_en = $request->office_name_eng;
        $userOffice->status = 1;
        $userOffice->created_by = $cdesk->officer_id;
        $userOffice->save();
    }
}
