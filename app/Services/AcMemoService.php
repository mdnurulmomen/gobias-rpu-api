<?php

namespace App\Services;

use App\Models\AcMemoAttachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Traits\SendNotification;
use App\Models\AcMemo;

class AcMemoService
{
    use SendNotification;

    public function store(Request $request): array
    {
        \DB::beginTransaction();
        try {

            $memo = $request->memo;
            //$memo_attachment = json_encode($memo['ac_memo_attachments']);

            $ac_memo = new AcMemo;
            $ac_memo->memo_id = $memo['id'];
            $ac_memo->directorate_id = $request->directorate_id;
            $ac_memo->directorate_en = $request->directorate_en;
            $ac_memo->directorate_bn = $request->directorate_bn;
            $ac_memo->directorate_address = $request->directorate_address;
            $ac_memo->directorate_website = $request->directorate_website;
            $ac_memo->onucched_no = $memo['onucched_no'];
            $ac_memo->memo_irregularity_type = $memo['memo_irregularity_type_name'];
            $ac_memo->memo_irregularity_sub_type = $memo['memo_irregularity_sub_type_name'];
            $ac_memo->cost_center_id = $memo['cost_center_id'];
            $ac_memo->cost_center_name_bn = $memo['cost_center_name_bn'];
            $ac_memo->cost_center_name_en = $memo['cost_center_name_en'];
            $ac_memo->fiscal_year_id = $memo['fiscal_year_id'];
            $ac_memo->fiscal_year = $memo['fiscal_year'];
            $ac_memo->ac_query_potro_no = $memo['ac_query_potro_no'];
            $ac_memo->audit_year_start = $memo['audit_year_start'];
            $ac_memo->audit_year_end = $memo['audit_year_end'];
            $ac_memo->ap_office_order_id = $memo['ap_office_order_id'];
            $ac_memo->audit_type = $memo['audit_type'];
            $ac_memo->audit_plan_id = $memo['audit_plan_id'];
            $ac_memo->team_id = $memo['team_id'];
            $ac_memo->team_leader_name = $memo['team_leader_name'];
            $ac_memo->team_leader_designation = $memo['team_leader_designation'];
            $ac_memo->sub_team_leader_name = $memo['sub_team_leader_name'];
            $ac_memo->sub_team_leader_designation = $memo['sub_team_leader_designation'];
            $ac_memo->issued_by = $request->issued_by;
            $ac_memo->memo_title_bn = $memo['memo_title_bn'];
            $ac_memo->memo_description_bn = $memo['memo_description_bn'];
            $ac_memo->irregularity_cause = $memo['irregularity_cause'];
            $ac_memo->memo_type = $memo['memo_type_name'];
            $ac_memo->memo_status = $memo['memo_status_name'];
            $ac_memo->memo_send_date = $request->memo_send_date;
            $ac_memo->jorito_ortho_poriman = $memo['jorito_ortho_poriman'];
            $ac_memo->response_of_rpu = $memo['response_of_rpu'];
            $ac_memo->audit_conclusion = $memo['audit_conclusion'];
            $ac_memo->audit_recommendation = $memo['audit_recommendation'];
            $ac_memo->status = 1;
            $ac_memo->memo_sharok_no = $request->memo_sharok_no;
            $ac_memo->memo_sharok_date = $request->memo_sharok_date;
            $ac_memo->sender_officer_id = $request->sender_officer_id;
            $ac_memo->sender_officer_name_bn = $request->sender_officer_name_bn;
            $ac_memo->sender_officer_name_en = $request->sender_officer_name_en;
            $ac_memo->sender_designation_id = $request->sender_designation_id;
            $ac_memo->sender_designation_bn = $request->sender_designation_bn;
            $ac_memo->sender_designation_en = $request->sender_designation_en;
            $ac_memo->rpu_acceptor_designation_name_bn = $request->rpu_acceptor_designation_name_bn;
            $ac_memo->memo_cc = $request->memo_cc;
            $ac_memo->save();

            //memo attachment store
            $memo_attachments = [];
            if (!empty($memo['ac_memo_attachments'])){
                foreach ($memo['ac_memo_attachments'] as $attachment){
                    array_push($memo_attachments, array(
                            'ac_memo_id' => $attachment['ac_memo_id'],
                            'directorate_id' => $request->directorate_id,
                            'directorate_bn' => $request->directorate_en,
                            'directorate_en' => $request->directorate_en,
                            'file_type' => $attachment['file_type'],
                            'file_user_define_name' => $attachment['file_user_define_name'],
                            'file_custom_name' => $attachment['file_custom_name'],
                            'file_dir' => $attachment['file_dir'],
                            'file_path' => $attachment['file_path'],
                            'file_size' => $attachment['file_size'],
                            'file_extension' => $attachment['file_extension'],
                            'sequence' => $attachment['sequence'],
                            'created_by' => $request->sender_officer_id,
                            'modified_by' => $request->sender_officer_id,
                            'deleted_by' => $request->sender_officer_id,
                        )
                    );
                }
            }
            if (!empty($memo_attachments)) {
                AcMemoAttachment::insert($memo_attachments);
            }
            \DB::commit();
            return ['status' => 'success', 'data' => 'Send Successfully'];
        } catch (\Exception $exception) {
            \DB::rollback();
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
            $ac_memo->audit_conclusion = $memo['audit_conclusion'];
            $ac_memo->response_of_rpu = $memo['response_of_rpu'];
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
