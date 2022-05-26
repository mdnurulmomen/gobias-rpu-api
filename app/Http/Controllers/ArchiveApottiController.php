<?php

namespace App\Http\Controllers;

use App\Models\AcMemo;
use App\Models\AcMemoAttachment;
use App\Models\Apotti;
use App\Models\ApottiItem;
use Illuminate\Http\Request;
use App\Services\AcMemoService;
use DB;
use Illuminate\Support\Arr;

class ArchiveApottiController extends Controller
{
    public function migrateArchiveApottiToRPU(Request $request)
    {
        try {
            DB::beginTransaction();
            $memo = $request->memo;
            $memo = json_decode($memo, true);
            $directorate = $request->directorate;
            $directorate = json_decode($directorate, true);
            $attachments = json_decode($request->attachments, true);
            $office_apottis = json_decode($request->apotti, true);
            $office_apotti_items = json_decode($request->apotti_item, true);

            $rp_ac_memo_data = [
                'memo_id' => $memo['id'],
                'onucched_no' => $request->onucched_no,
                'ac_query_potro_no' => 0,
                'team_id' => 0,
                'directorate_id' => $directorate['id'],
                'directorate_bn' => $directorate['office_name_bng'],
                'directorate_en' => $directorate['office_name_eng'],
                'directorate_address' => $directorate['office_address'],
                'directorate_website' => $directorate['office_web'],
                'cost_center_id' => $memo['cost_center_id'],
                'cost_center_name_en' => $memo['cost_center_name_en'],
                'cost_center_name_bn' => $memo['cost_center_name_bn'],
                'cover_page' => $memo['cover_page'],
                'file_token_no' => $memo['file_token_no'],
                'cover_page_path' => $memo['cover_page_path'],
                'attachment_path' => $memo['attachment_path'],
                'report_type_id' => $memo['report_type_id'],
                'memo_irregularity_type' => $memo['memo_irregularity_type'] ?: 0,
                'memo_irregularity_sub_type' => $memo['memo_irregularity_sub_type'] ?: 0,
                'fiscal_year_id' => $memo['fiscal_year_id'],
                'fiscal_year' =>  $memo['fiscal_year'],
                'ap_office_order_id' => 0,
                'audit_plan_id' => 0,
                'audit_year_start' => $memo['audit_year_start'],
                'audit_year_end' => $memo['audit_year_end'],
                'audit_type' => $memo['audit_type'],
                'memo_title_bn' => $memo['memo_title_bn'],
                'irregularity_cause' => $memo['irregularity_cause'],
                'memo_type' => 0,
                'memo_status' => 0,
                'status' => 'draft',
                'jorito_ortho_poriman' => $memo['jorito_ortho_poriman'],
                'onishponno_jorito_ortho_poriman' => $memo['onishponno_jorito_ortho_poriman'],
                'is_archived' => 1,
            ];

            $rp_ac_memo_create = AcMemo::create($rp_ac_memo_data);

            $rp_ac_memo_attachment_data = [];
            $sequence = 0;
            foreach ($attachments as $archived_memo_attachment) {
                $file_ext = explode('.', $archived_memo_attachment['attachment_name']);
                $file_ext = end($file_ext);
                if (strlen($file_ext) < 3 || strlen($file_ext) > 5) {
                    $file_ext = 'jpg';
                }
                $rp_ac_memo_attachment_data[] = [
                    'directorate_id' => $directorate['id'],
                    'directorate_bn' => $directorate['office_name_bng'],
                    'directorate_en' => $directorate['office_name_eng'],
                    'ac_memo_id' => $memo['id'],
                    'file_type' => $archived_memo_attachment['attachment_type'],
                    'file_user_define_name' => $archived_memo_attachment['attachment_name'],
                    'file_custom_name' => $archived_memo_attachment['attachment_name'],
                    'file_path' => $archived_memo_attachment['attachment_path'],
                    'file_extension' => $file_ext,
                    'sequence' => $sequence + 1,
                    'created_by' => 0,
                    'modified_by' => 0,
                ];
            }
            $rp_ac_memo_attachment_create = AcMemoAttachment::insert($rp_ac_memo_attachment_data);

            //RP APOTTI
            $rp_apotti = [
                'apotti_id' => $office_apottis['id'],
                'air_id' => 0,
                'audit_plan_id' => Arr::has($office_apottis, 'audit_plan_id') ? $office_apottis['audit_plan_id'] : '',
                'apotti_title' => Arr::has($office_apottis, 'apotti_title') ? $office_apottis['apotti_title'] : '',
                'apotti_description' => Arr::has($office_apottis, 'apotti_description') ? $office_apottis['apotti_description'] : '',
                'apotti_type' => Arr::has($office_apottis, 'apotti_type') ? $office_apottis['apotti_type'] : '',
                'onucched_no' => Arr::has($office_apottis, 'onucched_no') ? $office_apottis['onucched_no'] : '',
                'ministry_id' => Arr::has($office_apottis, 'ministry_id') ? $office_apottis['ministry_id'] : '',
                'ministry_name_en' => Arr::has($office_apottis, 'ministry_name_en') ? $office_apottis['ministry_name_en'] : '',
                'ministry_name_bn' => Arr::has($office_apottis, 'ministry_name_bn') ? $office_apottis['ministry_name_bn'] : '',
                'parent_office_id' => Arr::has($office_apottis, 'parent_office_id') ? $office_apottis['parent_office_id'] : '',
                'parent_office_name_en' => Arr::has($office_apottis, 'parent_office_name_en') ? $office_apottis['parent_office_name_en'] : '',
                'parent_office_name_bn' => Arr::has($office_apottis, 'parent_office_name_bn') ? $office_apottis['parent_office_name_bn'] : '',
                'fiscal_year_id' => Arr::has($office_apottis, 'fiscal_year_id') ? $office_apottis['fiscal_year_id'] : '',
                'total_jorito_ortho_poriman' => Arr::has($office_apottis, 'total_jorito_ortho_poriman') ? $office_apottis['total_jorito_ortho_poriman'] : '',
                'total_onishponno_jorito_ortho_poriman' => Arr::has($office_apottis, 'total_onishponno_jorito_ortho_poriman') ? $office_apottis['total_onishponno_jorito_ortho_poriman'] : '',
                'response_of_rpu' => Arr::has($office_apottis, 'response_of_rpu') ? $office_apottis['response_of_rpu'] : '',
                'irregularity_cause' => Arr::has($office_apottis, 'irregularity_cause') ? $office_apottis['irregularity_cause'] : '',
                'audit_conclusion' => Arr::has($office_apottis, 'audit_conclusion') ? $office_apottis['audit_conclusion'] : '',
                'audit_recommendation' => Arr::has($office_apottis, 'audit_recommendation') ? $office_apottis['audit_recommendation'] : '',
                'created_by' => 0,
                'approve_status' => Arr::has($office_apottis, 'approve_status') ? $office_apottis['approve_status'] : '',
                'status' => Arr::has($office_apottis, 'status') ? $office_apottis['status'] : '',
                'comment' => Arr::has($office_apottis, 'comment') ? $office_apottis['comment'] : '',
                'apotti_sequence' => Arr::has($office_apottis, 'apotti_sequence') ? $office_apottis['apotti_sequence'] : '',
                'is_combined' => Arr::has($office_apottis, 'is_combined') ? $office_apottis['is_combined'] : '',
            ];

            Apotti::create($rp_apotti);

            $rp_apotti_item = [
                'apotti_id' => $office_apottis['id'],
                'apotti_item_id' => Arr::has($office_apotti_items, 'id') ? $office_apotti_items['id'] : '',
                'memo_id' => Arr::has($office_apotti_items, 'memo_id') ? $office_apotti_items['memo_id'] : '',
                'onucched_no' => Arr::has($office_apotti_items, 'onucched_no') ? $office_apotti_items['onucched_no'] : '',
                'memo_irregularity_type' => Arr::has($office_apotti_items, 'memo_irregularity_type') ? $office_apotti_items['memo_irregularity_type'] : '',
                'memo_irregularity_sub_type' => Arr::has($office_apotti_items, 'memo_irregularity_sub_type') ? $office_apotti_items['memo_irregularity_sub_type'] : '',
                'ministry_id' => Arr::has($office_apotti_items, 'ministry_id') ? $office_apotti_items['ministry_id'] : '',
                'ministry_name_en' => Arr::has($office_apotti_items, 'ministry_name_en') ? $office_apotti_items['ministry_name_en'] : '',
                'ministry_name_bn' => Arr::has($office_apotti_items, 'ministry_name_bn') ? $office_apotti_items['ministry_name_bn'] : '',
                'parent_office_id' => Arr::has($office_apotti_items, 'parent_office_id') ? $office_apotti_items['parent_office_id'] : '',
                'parent_office_name_en' => Arr::has($office_apotti_items, 'parent_office_name_en') ? $office_apotti_items['parent_office_name_en'] : '',
                'parent_office_name_bn' => Arr::has($office_apotti_items, 'parent_office_name_bn') ? $office_apotti_items['parent_office_name_bn'] : '',
                'cost_center_id' => Arr::has($office_apotti_items, 'cost_center_id') ? $office_apotti_items['cost_center_id'] : '',
                'cost_center_name_en' => Arr::has($office_apotti_items, 'cost_center_name_en') ? $office_apotti_items['cost_center_name_en'] : '',
                'cost_center_name_bn' => Arr::has($office_apotti_items, 'cost_center_name_bn') ? $office_apotti_items['cost_center_name_bn'] : '',
                'fiscal_year_id' => $memo['fiscal_year_id'],
                'fiscal_year' =>  $memo['fiscal_year'],
                'audit_year_start' => Arr::has($office_apotti_items, 'audit_year_start') ? $office_apotti_items['audit_year_start'] : '',
                'audit_year_end' => Arr::has($office_apotti_items, 'audit_year_end') ? $office_apotti_items['audit_year_end'] : '',
                'ac_query_potro_no' => Arr::has($office_apotti_items, 'ac_query_potro_no') ? $office_apotti_items['ac_query_potro_no'] : '',
                'ap_office_order_id' => Arr::has($office_apotti_items, 'ap_office_order_id') ? $office_apotti_items['ap_office_order_id'] : '',
                'audit_plan_id' => Arr::has($office_apotti_items, 'audit_plan_id') ? $office_apotti_items['audit_plan_id'] : '',
                'audit_type' => Arr::has($office_apotti_items, 'audit_type') ? $office_apotti_items['audit_type'] : '',
                'team_id' => Arr::has($office_apotti_items, 'team_id') ? $office_apotti_items['team_id'] : '',
                'memo_title_bn' => Arr::has($office_apotti_items, 'memo_title_bn') ? $office_apotti_items['memo_title_bn'] : '',
                'memo_description_bn' => Arr::has($office_apotti_items, 'memo_description_bn') ? $office_apotti_items['memo_description_bn'] : '',
                'memo_type' => Arr::has($office_apotti_items, 'memo_type') ? $office_apotti_items['memo_type'] : '',
                'memo_status' => Arr::has($office_apotti_items, 'memo_status') ? $office_apotti_items['memo_status'] : '',
                'jorito_ortho_poriman' => Arr::has($office_apotti_items, 'jorito_ortho_poriman') ? $office_apotti_items['jorito_ortho_poriman'] : '',
                'onishponno_jorito_ortho_poriman' => Arr::has($office_apotti_items, 'onishponno_jorito_ortho_poriman') ? $office_apotti_items['onishponno_jorito_ortho_poriman'] : '',
                'response_of_rpu' => Arr::has($office_apotti_items, 'response_of_rpu') ? $office_apotti_items['response_of_rpu'] : '',
                'irregularity_cause' => Arr::has($office_apotti_items, 'irregularity_cause') ? $office_apotti_items['irregularity_cause'] : '',
                'audit_conclusion' => Arr::has($office_apotti_items, 'audit_conclusion') ? $office_apotti_items['audit_conclusion'] : '',
                'audit_recommendation' => Arr::has($office_apotti_items, 'audit_recommendation') ? $office_apotti_items['audit_recommendation'] : '',
                'created_by' => 1,
                'status' => Arr::has($office_apotti_items, 'status') ? $office_apotti_items['status'] : '',
                'directorate_id' => $directorate['id'],
                'directorate_bn' => $directorate['office_name_bng'],
                'directorate_en' => $directorate['office_name_eng'],
            ];
            ApottiItem::create($rp_apotti_item);
            DB::commit();
            return ['status' => 'success', 'data' => 'Done RPU'];
        } catch (\Exception $exception) {
            DB::rollBack();
            \Log::error($exception->getMessage());
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
    public function migrateArchiveReportToRpu(Request $request)
    {
        try {
            DB::beginTransaction();
            $memo = $request->memo;
            $memos = json_decode($memo, true);
            $directorate = $request->directorate;
            $directorate = json_decode($directorate, true);
            $office_apottis = json_decode($request->apotti, true);
            $office_apotti_items = json_decode($request->apotti_item, true);

            $rp_ac_memo_data_arr = [];

            foreach ($memos as $memo) {
                $rp_ac_memo_data = [
                    'memo_id' => $memo['id'],
                    'onucched_no' => $memo['onucched_no'],
                    'ac_query_potro_no' => 0,
                    'team_id' => 0,
                    'directorate_id' => $directorate['id'],
                    'directorate_bn' => $directorate['office_name_bng'],
                    'directorate_en' => $directorate['office_name_eng'],
                    'directorate_address' => $directorate['office_address'],
                    'directorate_website' => $directorate['office_web'],
                    'cost_center_id' => $memo['cost_center_id'],
                    'cost_center_name_en' => $memo['cost_center_name_en'],
                    'cost_center_name_bn' => $memo['cost_center_name_bn'],
                    'cover_page' => $memo['cover_page'],
                    'file_token_no' => $memo['file_token_no'],
                    'cover_page_path' => $memo['cover_page_path'],
                    'attachment_path' => $memo['attachment_path'],
                    'report_type_id' => $memo['report_type_id'],
                    'memo_irregularity_type' => $memo['memo_irregularity_type'] ?: 0,
                    'memo_irregularity_sub_type' => $memo['memo_irregularity_sub_type'] ?: 0,
                    'fiscal_year_id' => $memo['fiscal_year_id'],
                    'fiscal_year' =>  $memo['fiscal_year'],
                    'ap_office_order_id' => 0,
                    'audit_plan_id' => 0,
                    'audit_year_start' => $memo['audit_year_start'],
                    'audit_year_end' => $memo['audit_year_end'],
                    'audit_type' => $memo['audit_type'],
                    'memo_title_bn' => $memo['memo_title_bn'],
                    'irregularity_cause' => $memo['irregularity_cause'],
                    'memo_type' => 0,
                    'memo_status' => 0,
                    'status' => 'draft',
                    'jorito_ortho_poriman' => $memo['jorito_ortho_poriman'],
                    'onishponno_jorito_ortho_poriman' => $memo['onishponno_jorito_ortho_poriman'],
                    'is_archived' => 1,
                ];

                $rp_ac_memo_data_arr[] = $rp_ac_memo_data;
            }
            RPAcMemo::insert($rp_ac_memo_data_arr);

            $rp_apotti_arr = [];
            foreach ($office_apottis as $office_apotti) {
                $rp_apotti = [
                    'apotti_id' => $office_apotti['id'],
                    'air_id' => 0,
                    'audit_plan_id' => Arr::has($office_apotti, 'audit_plan_id') ? $office_apotti['audit_plan_id'] : '',
                    'apotti_title' => Arr::has($office_apotti, 'apotti_title') ? $office_apotti['apotti_title'] : '',
                    'apotti_description' => Arr::has($office_apotti, 'apotti_description') ? $office_apotti['apotti_description'] : '',
                    'apotti_type' => Arr::has($office_apotti, 'apotti_type') ? $office_apotti['apotti_type'] : '',
                    'onucched_no' => Arr::has($office_apotti, 'onucched_no') ? $office_apotti['onucched_no'] : '',
                    'ministry_id' => Arr::has($office_apotti, 'ministry_id') ? $office_apotti['ministry_id'] : '',
                    'ministry_name_en' => Arr::has($office_apotti, 'ministry_name_en') ? $office_apotti['ministry_name_en'] : '',
                    'ministry_name_bn' => Arr::has($office_apotti, 'ministry_name_bn') ? $office_apotti['ministry_name_bn'] : '',
                    'parent_office_id' => Arr::has($office_apotti, 'parent_office_id') ? $office_apotti['parent_office_id'] : '',
                    'parent_office_name_en' => Arr::has($office_apotti, 'parent_office_name_en') ? $office_apotti['parent_office_name_en'] : '',
                    'parent_office_name_bn' => Arr::has($office_apotti, 'parent_office_name_bn') ? $office_apotti['parent_office_name_bn'] : '',
                    'fiscal_year_id' => Arr::has($office_apotti, 'fiscal_year_id') ? $office_apotti['fiscal_year_id'] : '',
                    'total_jorito_ortho_poriman' => Arr::has($office_apotti, 'total_jorito_ortho_poriman') ? $office_apotti['total_jorito_ortho_poriman'] : '',
                    'total_onishponno_jorito_ortho_poriman' => Arr::has($office_apotti, 'total_onishponno_jorito_ortho_poriman') ? $office_apotti['total_onishponno_jorito_ortho_poriman'] : '',
                    'response_of_rpu' => Arr::has($office_apotti, 'response_of_rpu') ? $office_apotti['response_of_rpu'] : '',
                    'irregularity_cause' => Arr::has($office_apotti, 'irregularity_cause') ? $office_apotti['irregularity_cause'] : '',
                    'audit_conclusion' => Arr::has($office_apotti, 'audit_conclusion') ? $office_apotti['audit_conclusion'] : '',
                    'audit_recommendation' => Arr::has($office_apotti, 'audit_recommendation') ? $office_apotti['audit_recommendation'] : '',
                    'created_by' => 0,
                    'approve_status' => Arr::has($office_apotti, 'approve_status') ? $office_apotti['approve_status'] : '',
                    'status' => Arr::has($office_apotti, 'status') ? $office_apotti['status'] : '',
                    'comment' => Arr::has($office_apotti, 'comment') ? $office_apotti['comment'] : '',
                    'apotti_sequence' => Arr::has($office_apotti, 'apotti_sequence') ? $office_apotti['apotti_sequence'] : '',
                    'is_combined' => Arr::has($office_apotti, 'is_combined') ? $office_apotti['is_combined'] : '',
                ];

                $rp_apotti_arr = $rp_apotti;
            }
            Apotti::insert($rp_apotti_arr);

            $rp_apotti_item_arr = [];
            foreach ($office_apotti_items as $office_apotti_item) {
                $rp_apotti_item = [
                    'apotti_item_id' => Arr::has($office_apotti_item, 'id') ? $office_apotti_item['id'] : '',
                    'apotti_id' => $office_apotti_item['apotti_id'],
                    'memo_id' => Arr::has($office_apotti_item, 'memo_id') ? $office_apotti_item['memo_id'] : '',
                    'onucched_no' => Arr::has($office_apotti_item, 'onucched_no') ? $office_apotti_item['onucched_no'] : '',
                    'memo_irregularity_type' => Arr::has($office_apotti_item, 'memo_irregularity_type') ? $office_apotti_item['memo_irregularity_type'] : '',
                    'memo_irregularity_sub_type' => Arr::has($office_apotti_item, 'memo_irregularity_sub_type') ? $office_apotti_item['memo_irregularity_sub_type'] : '',
                    'ministry_id' => Arr::has($office_apotti_item, 'ministry_id') ? $office_apotti_item['ministry_id'] : '',
                    'ministry_name_en' => Arr::has($office_apotti_item, 'ministry_name_en') ? $office_apotti_item['ministry_name_en'] : '',
                    'ministry_name_bn' => Arr::has($office_apotti_item, 'ministry_name_bn') ? $office_apotti_item['ministry_name_bn'] : '',
                    'parent_office_id' => Arr::has($office_apotti_item, 'parent_office_id') ? $office_apotti_item['parent_office_id'] : '',
                    'parent_office_name_en' => Arr::has($office_apotti_item, 'parent_office_name_en') ? $office_apotti_item['parent_office_name_en'] : '',
                    'parent_office_name_bn' => Arr::has($office_apotti_item, 'parent_office_name_bn') ? $office_apotti_item['parent_office_name_bn'] : '',
                    'cost_center_id' => Arr::has($office_apotti_item, 'cost_center_id') ? $office_apotti_item['cost_center_id'] : '',
                    'cost_center_name_en' => Arr::has($office_apotti_item, 'cost_center_name_en') ? $office_apotti_item['cost_center_name_en'] : '',
                    'cost_center_name_bn' => Arr::has($office_apotti_item, 'cost_center_name_bn') ? $office_apotti_item['cost_center_name_bn'] : '',
                    'fiscal_year_id' => $memo['fiscal_year_id'],
                    'fiscal_year' =>  $memo['fiscal_year'],
                    'audit_year_start' => Arr::has($office_apotti_item, 'audit_year_start') ? $office_apotti_item['audit_year_start'] : '',
                    'audit_year_end' => Arr::has($office_apotti_item, 'audit_year_end') ? $office_apotti_item['audit_year_end'] : '',
                    'ac_query_potro_no' => Arr::has($office_apotti_item, 'ac_query_potro_no') ? $office_apotti_item['ac_query_potro_no'] : '',
                    'ap_office_order_id' => Arr::has($office_apotti_item, 'ap_office_order_id') ? $office_apotti_item['ap_office_order_id'] : '',
                    'audit_plan_id' => Arr::has($office_apotti_item, 'audit_plan_id') ? $office_apotti_item['audit_plan_id'] : '',
                    'audit_type' => Arr::has($office_apotti_item, 'audit_type') ? $office_apotti_item['audit_type'] : '',
                    'team_id' => Arr::has($office_apotti_item, 'team_id') ? $office_apotti_item['team_id'] : '',
                    'memo_title_bn' => Arr::has($office_apotti_item, 'memo_title_bn') ? $office_apotti_item['memo_title_bn'] : '',
                    'memo_description_bn' => Arr::has($office_apotti_item, 'memo_description_bn') ? $office_apotti_item['memo_description_bn'] : '',
                    'memo_type' => Arr::has($office_apotti_item, 'memo_type') ? $office_apotti_item['memo_type'] : '',
                    'memo_status' => Arr::has($office_apotti_item, 'memo_status') ? $office_apotti_item['memo_status'] : '',
                    'jorito_ortho_poriman' => Arr::has($office_apotti_item, 'jorito_ortho_poriman') ? $office_apotti_item['jorito_ortho_poriman'] : '',
                    'onishponno_jorito_ortho_poriman' => Arr::has($office_apotti_item, 'onishponno_jorito_ortho_poriman') ? $office_apotti_item['onishponno_jorito_ortho_poriman'] : '',
                    'response_of_rpu' => Arr::has($office_apotti_item, 'response_of_rpu') ? $office_apotti_item['response_of_rpu'] : '',
                    'irregularity_cause' => Arr::has($office_apotti_item, 'irregularity_cause') ? $office_apotti_item['irregularity_cause'] : '',
                    'audit_conclusion' => Arr::has($office_apotti_item, 'audit_conclusion') ? $office_apotti_item['audit_conclusion'] : '',
                    'audit_recommendation' => Arr::has($office_apotti_item, 'audit_recommendation') ? $office_apotti_item['audit_recommendation'] : '',
                    'created_by' => 1,
                    'status' => Arr::has($office_apotti_item, 'status') ? $office_apotti_item['status'] : '',
                    'directorate_id' => $directorate['id'],
                    'directorate_bn' => $directorate['office_name_bng'],
                    'directorate_en' => $directorate['office_name_eng'],
                ];

                $rp_apotti_item_arr[] = $rp_apotti_item;
            }
            ApottiItem::insert($rp_apotti_item_arr);
        } catch (\Exception $exception) {
            DB::rollBack();
            \Log::error($exception->getMessage());
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }
}
