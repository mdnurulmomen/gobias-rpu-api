<?php

namespace App\Services;
use App\Models\RAir;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Traits\SendNotification;

class RpuAirReportService
{
    use SendNotification;

    public function store(Request $request): array
    {
        try {

//            return ['status' => 'success', 'data' => $request->air_list];

            $air_list = $request->air_list;
//            return $request->air_list;

            foreach ($air_list as $air_info){
                $air = new RAir;
                $air->air_id = $air_info['air_id'];
                $air->report_number = $air_info['report_number'];
                $air->fiscal_year_id = $air_info['fiscal_year_id'];
                $air->fiscal_year = $air_info['fiscal_year'];
                $air->cost_center_id = $air_info['cost_center_id'];
                $air->annual_plan_id = $air_info['annual_plan_id'];
                $air->activity_id = $air_info['activity_id'];
                $air->audit_plan_id = $air_info['audit_plan_id'];
                $air->air_description = $air_info['air_description'];
                $air->directorate_id = $air_info['directorate_id'];
                $air->directorate_en = $air_info['directorate_en'];
                $air->directorate_bn = $air_info['directorate_bn'];
                $air->sender_id = $air_info['sender_id'];
                $air->sender_name_en = $air_info['sender_en'];
                $air->sender_name_bn = $air_info['sender_bn'];
                $air->send_date = $air_info['send_date'];
                $air->save();
            }


            return ['status' => 'success', 'data' => 'Send Air Successfully'];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
}
