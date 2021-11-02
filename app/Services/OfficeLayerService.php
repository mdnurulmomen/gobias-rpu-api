<?php

namespace App\Services;

use App\Models\OfficeLayer;
use App\Repository\Eloquent\OfficeLayerRepository;
use Illuminate\Http\Request;

class OfficeLayerService
{
    public function __construct(OfficeLayerRepository $officeLayerRepository)
    {
        $this->officeLayerRepository = $officeLayerRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->officeLayerRepository->store($request, $cdesk);
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        } catch (\Exception $exception) {
            $returnData = ['status' => 'error', 'data' => $exception];
        }
        return $returnData;
    }

    public function update(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->officeLayerRepository->update($request, $cdesk);
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে হালনাগাদ করা হয়েছে।'];
        } catch (\Exception $exception) {
            $returnData = ['status' => 'error', 'data' => $exception];
        }
        return $returnData;
    }


    public function show($officeLayerId)
    {
        try {
            $officeLayerInfo = $this->officeLayerRepository->show($officeLayerId);
            return ['status' => 'success', 'data' => $officeLayerInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function list(Request $request)
    {
        try {
            $office_layer_list = $this->officeLayerRepository->list($request);
            return ['status' => 'success', 'data' => $office_layer_list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getOfficeLayerMinistryWise($ministryId)
    {
        try {
            $officeLayerInfo = $this->officeLayerRepository->getOfficeLayerMinistryWise($ministryId);
            return ['status' => 'success', 'data' => $officeLayerInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getOfficeLayerTreeMinistryWise($ministryId)
    {
        try {
            $officeLayerInfo = $this->officeLayerRepository->getOfficeLayerTreeMinistryWise($ministryId);
            return ['status' => 'success', 'data' => $officeLayerInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getOfficeLayerParentAndMinistryWise(Request $request)
    {
        try {
            $officeLayers = $this->officeLayerRepository->getOfficeLayerParentAndMinistryWise($request);
            return ['status' => 'success', 'data' => $officeLayers];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getControllingOfficeLayerByMinistryOrDivision(Request $request)
    {
        try {
            $controlling_office_layers = OfficeLayer::select(
                'id',
                'layer_name_eng AS layer_name_en',
                'layer_name_bng AS layer_name_bn',
                'custom_layer_id',
            )->where('office_ministry_id', $request->office_ministry_id)->where('parent_layer_id', null)
                ->where('active_status', 1)
                ->orderBy('layer_level')
                ->orderBy('layer_sequence')
                ->get();
            return ['status' => 'success', 'data' => $controlling_office_layers];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getOfficeUnitLayerByControllingOfficeLayer(Request $request)
    {
        try {
            $office_unit_layers = OfficeLayer::select(
                'id',
                'layer_name_eng AS layer_name_en',
                'layer_name_bng AS layer_name_bn',
                'custom_layer_id',
            )->where('office_ministry_id', $request->office_ministry_id)->where('parent_layer_id', $request->controlling_office_layer_id)
                ->where('active_status', 1)
                ->orderBy('layer_level')
                ->orderBy('layer_sequence')
                ->get();
            return ['status' => 'success', 'data' => $office_unit_layers];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
