<?php

namespace App\Services;
use App\Repository\Eloquent\OfficeUnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeUnitService
{
    public function __construct(OfficeUnitRepository $officeUnitRepository)
    {
        $this->officeUnitRepository = $officeUnitRepository;
    }

    public function updateOfficeUnit(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        DB::beginTransaction();
        try {
            $this->officeUnitRepository->update($request, $cdesk);
            DB::commit();
            $return_data = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        } catch (\Exception $exception) {
            DB::rollback();
            $return_data = ['status' => 'error', 'data' => $exception];
        }

        return $return_data;
    }
}
