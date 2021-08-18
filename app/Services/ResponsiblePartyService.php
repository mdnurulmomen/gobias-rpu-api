<?php

namespace App\Services;

use App\Repository\Eloquent\ResponsiblePartyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponsiblePartyService
{
    public function __construct(ResponsiblePartyRepository $responsiblePartyRepository)
    {
        $this->responsiblePartyRepository = $responsiblePartyRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        DB::beginTransaction();
        try {
            $this->responsiblePartyRepository->store($request, $cdesk);
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
            $this->responsiblePartyRepository->update($request, $cdesk);
            DB::commit();
            $return_data = ['status' => 'success', 'data' => 'সফল্ভাবে হালনাগাদ করা হয়েছে।'];
        } catch (\Exception $exception) {
            DB::rollback();
            $return_data = ['status' => 'error', 'data' => $exception];
        }

        return $return_data;
    }

    public function show($responsible_party_id){
        try {
            $responsible_party_info = $this->responsiblePartyRepository->show($responsible_party_id);
            return ['status' => 'success', 'data' => $responsible_party_info];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function list(Request $request){
        try {
            $responsible_party_list = $this->responsiblePartyRepository->list($request);
            return ['status' => 'success', 'data' => $responsible_party_list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
