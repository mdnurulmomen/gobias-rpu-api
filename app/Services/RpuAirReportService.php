<?php

namespace App\Services;
use App\Models\Apotti;
use App\Models\ApottiItem;
use App\Models\Office;
use App\Models\RAir;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Traits\SendNotification;

class RpuAirReportService
{
    use SendNotification;

    public function store(Request $request): array
    {
        \DB::beginTransaction();
        try {
            $air_list = $request->air_list;

            foreach ($air_list as $air_info){
                $air = new RAir;
                $air->air_id = $air_info['air_id'];
                $air->report_number = $air_info['report_number'];
                $air->report_name = $air_info['report_name'];
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
                $air->last_date_of_reply = date('Y-m-d', strtotime("+15 day", strtotime($air_info['send_date'])));
                $air->save();
            }

            //for apotti
            $apotti_list = $request->apotti_list;
            foreach ($apotti_list as $apottiInfo){
                $apotti = new Apotti();
                $apotti->apotti_id = $apottiInfo['id'];
                $apotti->air_id = $request->air_id;
                $apotti->audit_plan_id = $apottiInfo['audit_plan_id'];
                $apotti->apotti_title = $apottiInfo['apotti_title'];
                $apotti->apotti_description = $apottiInfo['apotti_description'];
                $apotti->apotti_type = $apottiInfo['apotti_type'];
                $apotti->onucched_no = $apottiInfo['onucched_no'];
                $apotti->ministry_id = $apottiInfo['ministry_id'];
                $apotti->ministry_name_en = $apottiInfo['ministry_name_en'];
                $apotti->ministry_name_bn = $apottiInfo['ministry_name_bn'];
                $apotti->parent_office_id = $apottiInfo['parent_office_id'];
                $apotti->parent_office_name_en = $apottiInfo['parent_office_name_en'];
                $apotti->parent_office_name_bn = $apottiInfo['parent_office_name_bn'];
                $apotti->fiscal_year_id = $apottiInfo['fiscal_year_id'];
                $apotti->total_jorito_ortho_poriman = $apottiInfo['total_jorito_ortho_poriman'];
                $apotti->total_onishponno_jorito_ortho_poriman = $apottiInfo['total_onishponno_jorito_ortho_poriman'];
                $apotti->response_of_rpu = $apottiInfo['response_of_rpu'];
                $apotti->irregularity_cause = $apottiInfo['irregularity_cause'];
                $apotti->audit_conclusion = $apottiInfo['audit_conclusion'];
                $apotti->audit_recommendation = $apottiInfo['audit_recommendation'];
                $apotti->created_by = 1;
                $apotti->approve_status = $apottiInfo['approve_status'];
                $apotti->status = $apottiInfo['status'];
                $apotti->comment = $apottiInfo['comment'];
                $apotti->apotti_sequence = $apottiInfo['apotti_sequence'];
                $apotti->is_combined = $apottiInfo['is_combined'];
                $apotti->save();

                foreach ($apottiInfo['apotti_items'] as $item){
                    $ministry_office_id = Office::select('id')->where('office_ministry_id',$item['ministry_id'])
                        ->where('is_ministry',1)
                        ->first();
                    $ministry_office_id = $ministry_office_id?$ministry_office_id->id:null;

                    $apottiItem = new ApottiItem();
                    $apottiItem->apotti_id = $item['apotti_id'];
                    $apottiItem->apotti_item_id = $item['id'];
                    $apottiItem->memo_id = $item['memo_id'];
                    $apottiItem->onucched_no = $item['onucched_no'];
                    $apottiItem->memo_irregularity_type = $item['memo_irregularity_type'];
                    $apottiItem->memo_irregularity_sub_type = $item['memo_irregularity_sub_type'];
                    $apottiItem->ministry_id = $item['ministry_id'];
                    $apottiItem->ministry_name_en = $item['ministry_name_en'];
                    $apottiItem->ministry_name_bn = $item['ministry_name_bn'];
                    $apottiItem->parent_office_id = $item['parent_office_id'];
                    $apottiItem->parent_office_name_en = $item['parent_office_name_en'];
                    $apottiItem->parent_office_name_bn = $item['parent_office_name_bn'];
                    $apottiItem->cost_center_id = $item['cost_center_id'];
                    $apottiItem->cost_center_name_en = $item['cost_center_name_en'];
                    $apottiItem->cost_center_name_bn = $item['cost_center_name_bn'];
                    $apottiItem->fiscal_year_id = $item['fiscal_year_id'];
                    $apottiItem->audit_year_start = $item['audit_year_start'];
                    $apottiItem->audit_year_end = $item['audit_year_end'];
                    $apottiItem->ac_query_potro_no = $item['ac_query_potro_no'];
                    $apottiItem->ap_office_order_id = $item['ap_office_order_id'];
                    $apottiItem->audit_plan_id = $item['audit_plan_id'];
                    $apottiItem->audit_type = $item['audit_type'];
                    $apottiItem->team_id = $item['team_id'];
                    $apottiItem->memo_title_bn = $item['memo_title_bn'];
                    $apottiItem->memo_description_bn = $item['memo_description_bn'];
                    $apottiItem->memo_type = $item['memo_type'];
                    $apottiItem->memo_status = $item['memo_status'];
                    $apottiItem->jorito_ortho_poriman = $item['jorito_ortho_poriman'];
                    $apottiItem->onishponno_jorito_ortho_poriman = $item['onishponno_jorito_ortho_poriman'];
                    $apottiItem->response_of_rpu = $item['response_of_rpu'];
                    $apottiItem->irregularity_cause = $item['irregularity_cause'];
                    $apottiItem->audit_conclusion = $item['audit_conclusion'];
                    $apottiItem->audit_recommendation = $item['audit_recommendation'];
                    $apottiItem->ministry_office_id = $ministry_office_id; //ministry office id
                    $apottiItem->created_by = 1;
                    $apottiItem->status = $item['status'];
                    $apottiItem->directorate_id = $request->directorate_id;
                    $apottiItem->directorate_en = $request->directorate_en;
                    $apottiItem->directorate_bn = $request->directorate_bn;
                    $apottiItem->save();
                }
            }

            \DB::commit();
            return ['status' => 'success', 'data' => 'Send Air Successfully'];

        } catch (\Error $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        } catch (\Exception $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function updateApottiItem(Request $request): array
    {
        \DB::beginTransaction();
        try {

            $apotti_item = ApottiItem::where('directorate_id',$request->directorate_id)->where('apotti_item_id',$request->apotti_item_id)->first();

            $apotti_item->memo_status = $request->memo_status;
            $apotti_item->onishponno_jorito_ortho_poriman = $request->onishponno_jorito_ortho_poriman;
            $apotti_item->adjustment_ortho_poriman = $request->adjustment_ortho_poriman;
            $apotti_item->collected_amount = $request->collected_amount;
            $apotti_item->save();
            return ['status' => 'success', 'data' => $apotti_item];

             return ['status' => 'success', 'data' => 'Update Successfully'];

            \DB::commit();


        } catch (\Error $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        } catch (\Exception $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
}
