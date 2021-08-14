<?php

namespace App\Services;

use App\Repository\Eloquent\OfficeCustomLayerRepository;
use Illuminate\Http\Request;

class OfficeCustomLayerService
{
    public function __construct(OfficeCustomLayerRepository $OfficeCustomLayerRepository)
    {
        $this->officeCustomLayerRepository = $OfficeCustomLayerRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->officeCustomLayerRepository->store($request, $cdesk);
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
            $this->officeCustomLayerRepository->update($request, $cdesk);
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে হালনাগাদ করা হয়েছে।'];
        }
        catch (\Exception $exception) {
            $returnData = ['status' => 'error', 'data' => $exception];
        }
        return $returnData;
    }


    public function show($officeLayerId){

    }

    public function list(Request $request){
        try {
            $officeLayerInfo = $this->officeCustomLayerRepository->list($request);
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
