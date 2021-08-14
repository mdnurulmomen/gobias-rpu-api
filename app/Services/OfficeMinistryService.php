<?php

namespace App\Services;
use App\Repository\Eloquent\OfficeMinistryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeMinistryService
{
    public function __construct(OfficeMinistryRepository $officeMinistryRepository)
    {
        $this->officeMinistryRepository = $officeMinistryRepository;
    }

    public function store(Request $request): array
    {

    }

    public function update(Request $request): array
    {

    }

    public function show($ministry_id){
        try {
            $office_ministry_info = $this->officeMinistryRepository->show($ministry_id);
            return ['status' => 'success', 'data' => $office_ministry_info];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function list(Request $request){
        try {
            $office_ministry_list = $this->officeMinistryRepository->list($request);
            return ['status' => 'success', 'data' => $office_ministry_list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
