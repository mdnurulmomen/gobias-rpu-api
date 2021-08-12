<?php

namespace App\Services;

use App\Repository\Eloquent\OfficeLayerRepository;
use Illuminate\Http\Request;

class OfficeLayerService
{
    private $officeLayerRepository;

    public function __construct(OfficeLayerRepository $officeLayerRepository)
    {
        $this->officeLayerRepository = $officeLayerRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->officeLayerRepository->create($request, $cdesk);
            $return_data = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        }
        catch (\Exception $exception) {
            $return_data = ['status' => 'error', 'data' => $exception];
        }
        return $return_data;
    }

    public function update(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->officeLayerRepository->update($request, $cdesk);
            $return_data = ['status' => 'success', 'data' => 'সফল্ভাবে হালনাগাদ করা হয়েছে।'];
        }
        catch (\Exception $exception) {
            $return_data = ['status' => 'error', 'data' => $exception];
        }
        return $return_data;
    }


    public function show($office_layer_id){
        try {
            $officeLayerInfo = $this->officeLayerRepository->show($office_layer_id);
            return ['status' => 'success', 'data' => $officeLayerInfo];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
