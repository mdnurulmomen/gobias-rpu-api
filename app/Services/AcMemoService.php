<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\SendNotification;
use App\Models\AcMemo;

class AcMemoService
{
    use SendNotification;

    public function store(Request $request): array
    {
        try {

                $memos = $request->memos;

                foreach ($memos as $key => $memo){
                    $memo_attachment = json_encode($memo['ac_memo_attachments']);
                    $ac_memo = new AcMemo;
                    $ac_memo->onucched_no = $memo['onucched_no'];
                    $ac_memo->memo_irregularity_type = $memo['memo_irregularity_type_name'];
                    $ac_memo->memo_irregularity_sub_type = $memo['memo_irregularity_sub_type_name'];
                    $ac_memo->team_id = $memo['team_id'];
                    $ac_memo->cost_center_id = $memo['cost_center_id'];
                    $ac_memo->cost_center_name_bn = $memo['cost_center_name_bn'];
                    $ac_memo->cost_center_name_en = $memo['cost_center_name_en'];
                    $ac_memo->fiscal_year_id = $memo['fiscal_year_id'];
                    $ac_memo->ac_query_potro_no = $memo['ac_query_potro_no'];
                    $ac_memo->audit_year_start = $memo['audit_year_start'];
                    $ac_memo->audit_year_end = $memo['audit_year_end'];
                    $ac_memo->ap_office_order_id = $memo['ap_office_order_id'];
                    $ac_memo->memo_id = $memo['id'];
                    $ac_memo->memo_title_bn = $memo['memo_title_bn'];
                    $ac_memo->audit_type = $memo['audit_type'];
                    $ac_memo->audit_plan_id = $memo['audit_plan_id'];
                    $ac_memo->memo_description_bn = $memo['memo_description_bn'];
                    $ac_memo->memo_type = $memo['memo_type_name'];
                    $ac_memo->memo_status = $memo['memo_status_name'];
                    $ac_memo->memo_send_date = $request->memo_send_date;
                    $ac_memo->response_of_rpu = $memo['response_of_rpu'];
                    $ac_memo->audit_conclusion = $memo['audit_conclusion'];
                    $ac_memo->audit_recommendation = $memo['audit_recommendation'];
                    $ac_memo->jorito_ortho_poriman = $memo['jorito_ortho_poriman'];
                    $ac_memo->status = 1;
                    $ac_memo->memo_attachments = $memo_attachment;
                    $ac_memo->sender_officer_id = $request->sender_officer_id;
                    $ac_memo->sender_officer_name_bn = $request->sender_officer_name_bn;
                    $ac_memo->sender_officer_name_en = $request->sender_officer_name_en;
                    $ac_memo->save();
                }

                return ['status' => 'success', 'data' => 'Send Successfully'];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }


    public function update(Request $request): array
    {
        try {
            $memo = $request->memo_info;
            $memo_attachment = json_encode($memo['ac_memo_attachments']);
            $ac_memo = AcMemo::where('memo_id',$memo['id'])->first();
            $ac_memo->onucched_no = $memo['onucched_no'];
            $ac_memo->memo_irregularity_type = $memo['memo_irregularity_type'];
            $ac_memo->memo_irregularity_sub_type = $memo['memo_irregularity_sub_type'];
            $ac_memo->team_id = $memo['team_id'];
            $ac_memo->cost_center_id = $memo['cost_center_id'];
            $ac_memo->cost_center_name_bn = $memo['cost_center_name_bn'];
            $ac_memo->cost_center_name_en = $memo['cost_center_name_en'];
            $ac_memo->fiscal_year_id = $memo['fiscal_year_id'];
            $ac_memo->ac_query_potro_no = $memo['ac_query_potro_no'];
            $ac_memo->audit_year_start = $memo['audit_year_start'];
            $ac_memo->audit_year_end = $memo['audit_year_end'];
            $ac_memo->ap_office_order_id = $memo['ap_office_order_id'];
            $ac_memo->memo_id = $memo['id'];
            $ac_memo->memo_title_bn = $memo['memo_title_bn'];
            $ac_memo->audit_type = $memo['audit_type'];
            $ac_memo->audit_plan_id = $memo['audit_plan_id'];
            $ac_memo->memo_description_bn = $memo['memo_description_bn'];
            $ac_memo->memo_type = $memo['memo_type'];
            $ac_memo->memo_status = $memo['memo_status'];
            $ac_memo->audit_conclusion = $memo['audit_conclusion'];
            $ac_memo->audit_recommendation = $memo['audit_recommendation'];
            $ac_memo->jorito_ortho_poriman = $memo['jorito_ortho_poriman'];
            $ac_memo->status = 1;
            $ac_memo->memo_attachments = $memo_attachment;
            $ac_memo->save();

            return ['status' => 'success', 'data' => 'Update Successfully'];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }


    public function show(Request $request)
    {
        //
    }

}
