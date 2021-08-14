<?php

namespace App\Services;

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
        }
        catch (\Exception $exception) {
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
        }
        catch (\Exception $exception) {
            $returnData = ['status' => 'error', 'data' => $exception];
        }
        return $returnData;
    }


    public function show($officeLayerId){
        try {
            $officeLayerInfo = $this->officeLayerRepository->show($officeLayerId);
            return ['status' => 'success', 'data' => $officeLayerInfo];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getLayerMinistryWise($ministryId){
        try {
            $officeLayerInfo = $this->officeLayerRepository->getLayerMinistryWise($ministryId);
            return ['status' => 'success', 'data' => $officeLayerInfo];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }


    public function delete(Request $request,$cdesk)
    {
        // TODO: Implement delete() method.
    }
}
