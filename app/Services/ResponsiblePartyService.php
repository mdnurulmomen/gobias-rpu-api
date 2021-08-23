<?php

namespace App\Services;

use App\Repository\Eloquent\ResponsiblePartyRepository;
use App\Repository\Eloquent\OfficeRepository;
use App\Repository\Eloquent\OfficeUnitRepository;
use App\Repository\Eloquent\RpInfoSectionBnRepository;
use App\Repository\Eloquent\RpInfoSectionEnRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponsiblePartyService
{
    public function __construct(ResponsiblePartyRepository $responsiblePartyRepository, OfficeRepository $officeRepository, OfficeUnitRepository $officeUnitRepository, RpInfoSectionBnRepository $rpInfoSectionBnRepository,RpInfoSectionEnRepository $rpInfoSectionEnRepository)
    {
        $this->responsiblePartyRepository = $responsiblePartyRepository;
        $this->OfficeRepository = $officeRepository;
        $this->OfficeUnitRepository = $officeUnitRepository;
        $this->rpInfoSectionBnRepository = $rpInfoSectionBnRepository;
        $this->rpInfoSectionEnRepository = $rpInfoSectionEnRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        DB::beginTransaction();
        try {
            $responsible_party_id = $this->responsiblePartyRepository->store($request, $cdesk);

            if(!empty($request->rp_info_section_id)){
                $store_rp_info_section_bn = $this->rpInfoSectionBnRepository->store($request,$responsible_party_id);
                $store_rp_info_section_en = $this->rpInfoSectionEnRepository->store($request,$responsible_party_id);
            }

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

    public function getCostCenterOffice(Request $request){
        try {
            $cost_center_offie_list = $this->OfficeRepository->getCostCenterOffice($request);
            return ['status' => 'success', 'data' => $cost_center_offie_list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getCostCenterUnit(Request $request){
        try {
            $cost_center_unit_list = $this->OfficeUnitRepository->getCostCenterUnit($request);
            return ['status' => 'success', 'data' => $cost_center_unit_list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
