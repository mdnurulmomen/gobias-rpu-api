<?php

namespace App\Repository\Eloquent;

use App\Models\Office;
use App\Models\OfficeOtherInfoDetail;
use App\Models\OfficeOtherInfoTitle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OfficeOtherInfoRepository
{

    //store
    public function store(Request $request, $contentList,$cdesk)
    {
        $officeOtherInfoList = array();
        foreach ($contentList as $content) {
            if (empty($content->content_detail_id)){
                $officeOtherInfoList[] = array(
                    'office_id'=> $request->office_id,
                    'content_title_id'=> $content->id,
                    'content'=> $content->content,
                    'created_by'=> $cdesk->user_primary_id,
                );
            }
            else{
                $officeOtherInfoDetail = OfficeOtherInfoDetail::find($content->content_detail_id);
                $officeOtherInfoDetail->office_id = $request->office_id;
                $officeOtherInfoDetail->content_title_id = $content->id;
                $officeOtherInfoDetail->content = $content->content;
                $officeOtherInfoDetail->updated_by = $cdesk->user_primary_id;
                $officeOtherInfoDetail->save();
            }

        }
        if (!empty($officeOtherInfoList)) {
            OfficeOtherInfoDetail::insert($officeOtherInfoList);
        }
    }

    //show
    public function show(Request $request){

        $response = array();
        $response['office_info'] = Office::select('id','office_name_bng','office_name_eng')
            ->where('id',$request->office_id)->first();

        if (OfficeOtherInfoDetail::where('office_id', $request->office_id)->exists()) {
            $officeInfoDetails = OfficeOtherInfoDetail::with(['office_other_info_title'])
                ->where('office_id', $request->office_id)->get();

            foreach ($officeInfoDetails as $officeInfo){
                $response['content_list'][]= [
                    "id" => (string) $officeInfo->office_other_info_title->id,
                    "content_detail_id" => $officeInfo->id,
                    "content_id" => $officeInfo->office_other_info_title->content_id,
                    "parent" => $officeInfo->office_other_info_title->parent_id == 0?"#":(string) $officeInfo->office_other_info_title->parent_id,
                    "text" => $officeInfo->office_other_info_title->title,
                    "content" => $officeInfo->content,
                ];
            }
        }
        else{
            $officeTitleList = OfficeOtherInfoTitle::get();
            foreach ($officeTitleList as $officeTitle){
                $response['content_list'][]= [
                    "id" => (string) $officeTitle->id,
                    "content_detail_id" => "",
                    "content_id" => $officeTitle->content_id,
                    "parent" => $officeTitle->parent_id == 0?"#":(string) $officeTitle->parent_id,
                    "text" => $officeTitle->title,
                    "content" => $officeTitle->title,
                ];
            }
        }

        return $response;
    }

    //get office other info list
    public function getOfficeOtherInfoList(Request $request){
        return OfficeOtherInfoDetail::with(['office_other_info_title'])
            ->where('office_id', $request->office_id)
            ->get()
            ->toArray();
    }
}
