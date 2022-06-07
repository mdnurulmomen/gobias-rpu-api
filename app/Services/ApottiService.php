<?php

namespace App\Services;

use App\Models\BroadSheetReply;
use App\Models\BroadSheetReplyItem;
use Illuminate\Http\Request;
use App\Models\ApottiItem;

class ApottiService
{
    public function getApottiItem(Request $request): array
    {
        try {
            $entity_id = $request->entity_id;

            $query = ApottiItem::query();

            $query->when($entity_id, function ($q, $entity_id) {
                return $q->where('parent_office_id', $entity_id);
            });

            $query->where('directorate_id', $request->directorate_id)
            ->where('ministry_id', $request->ministry_id)
            ->where('memo_type', $request->memo_type);

            $apotti_item_list = $query->get();

            return ['status' => 'success', 'data' => $apotti_item_list];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function getMinistryWiseApottiEntity(Request $request): array
    {
        try {
            $entity_list = ApottiItem::select('parent_office_id as entity_id','parent_office_name_en as entity_name_en','parent_office_name_bn as entity_name_bn')
                ->where('directorate_id', $request->directorate_id)
                ->where('ministry_id',$request->ministry_id)
                ->distinct()
                ->get();

            return ['status' => 'success', 'data' => $entity_list];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }


    public function apottiResponseSubmit(Request $request): array
    {
        try {
            $apotti_item = ApottiItem::where('directorate_id',$request->directorate_id)
                ->where('apotti_item_id',$request->apotti_item_id)
                ->first();

            $apotti_item->ministry_response = $request->ministry_response;
            $apotti_item->is_response_ministry = $request->ministry_response ? 1 : 0;

            $apotti_item->entity_response = $request->entity_response;
            $apotti_item->is_response_entity = $request->entity_response ? 1 : 0;

            $apotti_item->unit_response = $request->unit_response;
            $apotti_item->is_response_unit = $request->unit_response ? 1 : 0;
            $apotti_item->save();

            return ['status' => 'success', 'data' => 'update successfully'];
        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

    public function storeRpuBroadSheet(Request $request): array
    {
        try {

            $apottis = $request->apottis;

            ApottiItem::whereIn('apotti_item_id',$apottis)
                ->where('directorate_id',$request->directorate_id)
                ->update(['is_sent_amms'=> 1]);

            $apottiItems = ApottiItem::whereIn('apotti_item_id',$apottis)
                ->where('directorate_id',$request->directorate_id)
                ->with('apotti_attachements', function ($q){
                    return $q->where('file_type', 'broadsheet');
                })->get();

            //for broadsheet reply
            $broadSheetReply =  new BroadSheetReply();
            $broadSheetReply->directorate_id = $request->directorate_id;
            $broadSheetReply->directorate_bn = $request->directorate_bn;
            $broadSheetReply->directorate_en = $request->directorate_en;

            $broadSheetReply->ministry_id = $request->ministry_id;
            $broadSheetReply->ministry_name_en = $request->ministry_en;
            $broadSheetReply->ministry_name_bn = $request->ministry_bn;

            $broadSheetReply->memorandum_no = $request->memorandum_no;
            $broadSheetReply->memorandum_date = date('Y-m-d',strtotime($request->memorandum_date));
            $broadSheetReply->sender_office_id = $request->sender_type == 'ministry' ? $request->ministry_id : $request->entity_id;
            $broadSheetReply->sender_office_name_bn = $request->sender_type == 'ministry' ? $request->ministry_bn : $request->entity_bn;
            $broadSheetReply->sender_office_name_en = $request->sender_type == 'ministry' ? $request->ministry_en : $request->entity_en;;
            $broadSheetReply->sender_name_bn = $request->sender_name_bn;
            $broadSheetReply->sender_name_en = $request->sender_name_bn;
            $broadSheetReply->sender_type = $request->sender_type;
            $broadSheetReply->sender_designation_bn = $request->sender_designation_bn;
            $broadSheetReply->sender_designation_en = $request->sender_designation_en;
            $broadSheetReply->receiver_details = $request->receiver_details;
            $broadSheetReply->subject = $request->subject;
            $broadSheetReply->details = $request->details;
            $broadSheetReply->cc_list = $request->cc_list;
            $broadSheetReply->save();

            foreach ($apottiItems as $apottiItem){
                $broadSheetReplyItem =  new BroadSheetReplyItem();
                $broadSheetReplyItem->broad_sheet_reply_id = $broadSheetReply->id;
                $broadSheetReplyItem->apotti_id = $apottiItem->apotti_id;
                $broadSheetReplyItem->apotti_item_id = $apottiItem->apotti_item_id;
                $broadSheetReplyItem->memo_id = $apottiItem->memo_id;
                $broadSheetReplyItem->jorito_ortho_poriman = $apottiItem->jorito_ortho_poriman;
                $broadSheetReplyItem->save();
            }

            $data['broadsheet_reply_id'] = $broadSheetReply->id;
            $data['apottiItems'] = $apottiItems;
            $data['directorate_id'] = $request->directorate_id;
            $data['directorate_bn'] = $request->directorate_bn;
            $data['directorate_en'] = $request->directorate_en;
            $data['ministry_id'] = $request->ministry_id;
            $data['ministry_name_en'] = $request->ministry_en;
            $data['ministry_name_bn'] = $request->ministry_bn;
            $data['memorandum_no'] = $request->memorandum_no;
            $data['memorandum_date'] = $request->memorandum_date;
            $data['sender_office_id'] = 1;
            $data['sender_office_name_bn'] = 'safdsf';
            $data['sender_office_name_en'] = 'sdfasd';
            $data['sender_name_bn'] = 'sdfdf';
            $data['sender_name_en'] = 'dsfsdfds';
            $data['sender_designation_bn'] = 'sdfds';
            $data['sender_designation_en'] = 'sdfsd';
            $data['sender_type'] = 'entity';
            $data['receiver_details'] = $request->receiver_details;
            $data['subject'] = $request->subject;
            $data['details'] = $request->details;
            $data['cc_list'] = $request->cc_list;
            $data['broad_sheet_type'] = $request->broad_sheet_type;
            //$send_response = $this->initBeeHttp()->post(config('cag_amms_api.send_apotti_reply'), $data)->json();
            //dd($send_response);
            return ['status' => 'success', 'data' => $data];

        } catch (\Exception $exception) {
            return ['status' => 'error', 'data' => $exception->getMessage()];
        }
    }

}
