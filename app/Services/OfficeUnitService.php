<?php

namespace App\Services;
use App\Repository\Eloquent\OfficeUnitRepository;
use App\Repository\Eloquent\OfficeUnitCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeUnitService
{
    public function __construct(OfficeUnitRepository $officeUnitRepository,OfficeUnitCategoryRepository $officeUnitCategoryRepository)
    {
        $this->officeUnitRepository = $officeUnitRepository;
        $this->officeUnitCategoryRepository = $officeUnitCategoryRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        DB::beginTransaction();
        try {
            $this->officeUnitRepository->store($request, $cdesk);
            DB::commit();
            $return_data = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        } catch (\Exception $exception) {
            DB::rollback();
            $return_data = ['status' => 'error', 'data' => $exception];
        }

        return $return_data;
    }

    public function update(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        DB::beginTransaction();
        try {
            $this->officeUnitRepository->update($request, $cdesk);
            DB::commit();
            $return_data = ['status' => 'success', 'data' => 'সফল্ভাবে হালনাগাদ করা হয়েছে।'];
        } catch (\Exception $exception) {
            DB::rollback();
            $return_data = ['status' => 'error', 'data' => $exception];
        }

        return $return_data;
    }

    public function show($unit_id){
        try {
            $office_unit_info = $this->officeUnitRepository->show($unit_id);
            return ['status' => 'success', 'data' => $office_unit_info];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function list(Request $request){
        try {
            $office_unit_list = $this->officeUnitRepository->list($request);
            return ['status' => 'success', 'data' => $office_unit_list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function get_unit_category_list(Request $request){
        try {
            $office_unit_category_list = $this->officeUnitCategoryRepository->list($request);
            return ['status' => 'success', 'data' => $office_unit_category_list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
