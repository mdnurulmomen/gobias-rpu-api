<?php

namespace App\Services;

use App\Models\DonerAgency;
use Illuminate\Http\Request;

class DonerAgencyService
{
    public function store(Request $request): array
    {
        try {
            $doner_egency = new DonerAgency();
            $doner_egency->name_bn = $request->name_bn;
            $doner_egency->name_en = $request->name_en;
            $doner_egency->directorate_id = $request->directorate_id;
            $doner_egency->save();

            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function list(Request $request)
    {
        try {
            $doner_egency = DonerAgency::all()->sortDesc();

            return ['status' => 'success', 'data' => $doner_egency];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function show(Request $request)
    {
        try {
            $doner_egency = DonerAgency::where('id',$request->id)->first()->toArray();
            return ['status' => 'success', 'data' => $doner_egency];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
    public function update(Request $request): array
    {
        try {
            $doner_egency =DonerAgency::find($request->id);
            if(!$doner_egency){
                throw new \Exception('Donor Agency Not Found!');
            }
            $doner_egency->name_bn = $request->name_bn;
            $doner_egency->name_en = $request->name_en;
            $doner_egency->directorate_id = $request->directorate_id;
            $doner_egency->save();

            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

}
