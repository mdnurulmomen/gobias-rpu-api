<?php

namespace App\Services;
use App\Models\Apotti;
use App\Models\ApottiCommunication;
use App\Models\ApottiItem;
use App\Models\BroadsheetReplyFromDirectorate;
use App\Models\BroadSheetReplyItem;
use App\Models\Office;
use App\Models\PacMeetingApotti;
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
                $apotti->directorate_id = $request->directorate_id;
                $apotti->directorate_en = $request->directorate_en;
                $apotti->directorate_bn = $request->directorate_bn;
                $apotti->fiscal_year = $request->fiscal_year;
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
            \DB::commit();

             return ['status' => 'success', 'data' => 'Update Successfully'];

        } catch (\Error $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        } catch (\Exception $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function broadSheetReplyFromDirectorate(Request $request): array
    {
        \DB::beginTransaction();
        try {

            $reply_info = $request->reply_info;

            foreach ($request->item_info as $apoitti_item){
                $apotti_item = ApottiItem::where('directorate_id',$apoitti_item['directorate_id'])->where('apotti_item_id',$apoitti_item['apotti_item_id'])->first();
                $apotti_item->memo_status = $apoitti_item['memo_status'];
                $apotti_item->onishponno_jorito_ortho_poriman = $apoitti_item['onishponno_jorito_ortho_poriman'];
                $apotti_item->adjustment_ortho_poriman = $apoitti_item['adjustment_ortho_poriman'];
                $apotti_item->collected_amount = $apoitti_item['collected_amount'];
                $apotti_item->is_response_amms = 1;
                $apotti_item->directorate_response = $apoitti_item['directorate_response'];
                $apotti_item->current_location = 'unit';

                if($apoitti_item['memo_status'] != 1){
                    $apotti_item->unit_response = null;
                    $apotti_item->entity_response = null;
                    $apotti_item->ministry_response = null;
                    $apotti_item->is_response_unit = 0;
                    $apotti_item->is_response_entity = 0;
                    $apotti_item->is_response_ministry = 0;
                    $apotti_item->is_sent_amms = 0;
                }
                $apotti_item->save();

                //broadsheet reply item
                $broadSheetReplyItem = BroadSheetReplyItem::where('broad_sheet_reply_id',$apoitti_item['broad_sheet_reply_id'])
                    ->where('apotti_id',$apoitti_item['apotti_id'])
                    ->where('apotti_item_id',$apoitti_item['apotti_item_id'])
                    ->first();
                $broadSheetReplyItem->status_reason = $apoitti_item['status_reason'];
                $broadSheetReplyItem->save();

                //communication
                $apottiCommunication = new ApottiCommunication();
                $apottiCommunication->memorandum_no = $reply_info['memorandum_no'];
                $apottiCommunication->memorandum_date = $reply_info['memorandum_date'];
                $apottiCommunication->directorate_id = $apoitti_item['directorate_id'];
                $apottiCommunication->directorate_en = $apoitti_item['directorate_en'];
                $apottiCommunication->directorate_bn = $apoitti_item['directorate_bn'];
                $apottiCommunication->apotti_item_id = $apoitti_item['apotti_item_id'];
                $apottiCommunication->apotti_id = $apoitti_item['apotti_id'];
                $apottiCommunication->apotti_type = $apotti_item['memo_type'];
                $apottiCommunication->status = $apoitti_item['memo_status'];
                $apottiCommunication->message = $apoitti_item['directorate_response'];
                $apottiCommunication->sender_office_id = $reply_info['sender_id'];
                $apottiCommunication->sender_office_en = $reply_info['sender_name_en'];
                $apottiCommunication->sender_office_bn = $reply_info['sender_name_bn'];
                $apottiCommunication->sender_user_id = 0;
                $apottiCommunication->sender_designation_id = $reply_info['sender_designation_id'];
                $apottiCommunication->sender_designation_en = $reply_info['sender_designation_en'];
                $apottiCommunication->sender_designation_bn = $reply_info['sender_designation_bn'];
                $apottiCommunication->sender_type = 'directorate';
                $apottiCommunication->receiver_office_id = 0;
                $apottiCommunication->receiver_user_id = 0;

                if($apotti_item['memo_type'] == 'sfi'){
                    $receiver_type = 'ministry';
                }elseif ($apotti_item['memo_type'] == 'non-sfi'){
                    $receiver_type = 'entity';
                }

                $apottiCommunication->receiver_type = $receiver_type;
                $apottiCommunication->save();
            }

            $broadsheetReplyFromDirectorate = new BroadsheetReplyFromDirectorate;
            $broadsheetReplyFromDirectorate->id = $reply_info['id'];
            $broadsheetReplyFromDirectorate->directorate_id = $reply_info['directorate_id'];
            $broadsheetReplyFromDirectorate->broad_sheet_reply_id = $reply_info['broad_sheet_reply_id'];
            $broadsheetReplyFromDirectorate->ref_memorandum_no = $reply_info['ref_memorandum_no'];
            $broadsheetReplyFromDirectorate->memorandum_no = $reply_info['memorandum_no'];
            $broadsheetReplyFromDirectorate->memorandum_date = $reply_info['memorandum_date'];
            $broadsheetReplyFromDirectorate->rpu_office_head_details = $reply_info['rpu_office_head_details'];
            $broadsheetReplyFromDirectorate->subject = $reply_info['subject'];
            $broadsheetReplyFromDirectorate->description = $reply_info['description'];
            $broadsheetReplyFromDirectorate->braod_sheet_cc = $reply_info['braod_sheet_cc'];
            $broadsheetReplyFromDirectorate->sender_id = $reply_info['sender_id'];
            $broadsheetReplyFromDirectorate->sender_name_bn = $reply_info['sender_name_bn'];
            $broadsheetReplyFromDirectorate->sender_name_en = $reply_info['sender_name_en'];
            $broadsheetReplyFromDirectorate->sender_office_address = $reply_info['sender_office_address'];
            $broadsheetReplyFromDirectorate->sender_designation_id = $reply_info['sender_designation_id'];
            $broadsheetReplyFromDirectorate->sender_designation_bn = $reply_info['sender_designation_bn'];
            $broadsheetReplyFromDirectorate->sender_designation_en = $reply_info['sender_designation_en'];
            $broadsheetReplyFromDirectorate->sender_unit_id = $reply_info['sender_unit_id'];
            $broadsheetReplyFromDirectorate->sender_unit_bn = $reply_info['sender_unit_bn'];
            $broadsheetReplyFromDirectorate->sender_unit_en = $reply_info['sender_unit_en'];
            $broadsheetReplyFromDirectorate->save();

            \DB::commit();

            return ['status' => 'success', 'data' => 'সফলভাবে রেসপন্সিবল পার্টিতে প্রেরণ করা হয়নি'];

        } catch (\Error $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        } catch (\Exception $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function apottiFinalStatusUpdate(Request $request): array
    {
        \DB::beginTransaction();
        try {

            Apotti::where('directorate_id',$request->directorate_id)
                ->whereIn('apotti_id',$request->approved_apottis)
                ->update(['apotti_type' => 'approved']);

            ApottiItem::where('directorate_id',$request->directorate_id)
                ->whereIn('apotti_id',$request->approved_apottis)
                ->update(['memo_type' => 'approved']);

            \DB::commit();

            return ['status' => 'success', 'data' => 'Update Successfully'];

        } catch (\Error $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        } catch (\Exception $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function sendMeetingApottiToRpu(Request $request): array
    {
        \DB::beginTransaction();
        try {


            foreach ($request->meeting_apottis as $meeting_apottis){
                $pac_meeting_apotti = new PacMeetingApotti;
                $pac_meeting_apotti->meeting_id = $request->meeting_id;
                $pac_meeting_apotti->directorate_id = $request->directorate_id;
                $pac_meeting_apotti->directorate_en = $request->directorate_en;
                $pac_meeting_apotti->directorate_bn = $request->directorate_bn;
                $pac_meeting_apotti->apotti_id = $meeting_apottis;
                $pac_meeting_apotti->created_at = date('Y-m-d');
                $pac_meeting_apotti->save();
            }

            \DB::commit();

            return ['status' => 'success', 'data' => $request->all()];

        } catch (\Error $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        } catch (\Exception $exception) {
            \DB::rollback();
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
}
