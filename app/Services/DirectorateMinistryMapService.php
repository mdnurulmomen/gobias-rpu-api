<?php

namespace App\Services;

use App\Repository\Eloquent\DirectorateMinistryMapRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectorateMinistryMapService
{
    public function __construct(DirectorateMinistryMapRepository $directorateMinistryRepository)
    {
        $this->directorateMinistryRepository = $directorateMinistryRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        DB::beginTransaction();
        try {
            $this->directorateMinistryRepository->store($request, $cdesk);
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
            $this->directorateMinistryRepository->update($request, $cdesk);
            DB::commit();
            $return_data = ['status' => 'success', 'data' => 'সফল্ভাবে হালনাগাদ করা হয়েছে।'];
        } catch (\Exception $exception) {
            DB::rollback();
            $return_data = ['status' => 'error', 'data' => $exception];
        }

        return $return_data;
    }

    public function show($directorate_ministry_map_id){
        try {
            $office_unit_info = $this->directorateMinistryRepository->show($directorate_ministry_map_id);
            return ['status' => 'success', 'data' => $office_unit_info];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }


    public function list(Request $request){
        try {
            $directorateMinistryMapList = $this->directorateMinistryRepository->list($request);
            return ['status' => 'success', 'data' => $directorateMinistryMapList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getDirectorWiseMinistryList(Request $request){
        try {
            $list = $this->directorateMinistryRepository->getDirectorWiseMinistryList($request);
            return ['status' => 'success', 'data' => $list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

}
