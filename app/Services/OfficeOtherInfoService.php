<?php

namespace App\Services;

use App\Repository\Eloquent\OfficeOtherInfoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OfficeOtherInfoService
{
    public function __construct(OfficeOtherInfoRepository $officeOtherInfoRepository)
    {
        $this->officeOtherInfoRepository = $officeOtherInfoRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        $contentList = json_decode($request->content_list);
        try {
            $this->officeOtherInfoRepository->store($request, $contentList,$cdesk);
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        }
        catch (\Exception $exception) {
            $returnData = ['status' => 'error', 'data' => $exception];
        }
        return $returnData;
    }


    public function show(Request $request){
        try {
            $officeInfo = $this->officeOtherInfoRepository->show($request);
            return ['status' => 'success', 'data' => $officeInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
