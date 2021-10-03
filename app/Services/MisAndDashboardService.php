<?php

namespace App\Services;

use App\Models\Document;
use App\Repository\Eloquent\OfficeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Traits\SendNotification;

class MisAndDashboardService
{
    use SendNotification;

    public function __construct(OfficeRepository $officeRepository)
    {
        $this->officeRepository = $officeRepository;
    }

    public function rpuList(Request $request){
        $getRupListReport = $this->officeRepository->getRupListMis($request);
        return ['status' => 'success', 'data' => $getRupListReport];
    }

}
