<?php

namespace App\Http\Controllers;


use App\Models\Document;
use App\Models\Office;
use App\Models\OfficeOrigin;
use App\Models\User;
use App\Models\UserOffice;
use Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class OfficeController extends Controller
{
    public function storeOffice(Request $request){
        DB::beginTransaction();
        try {
            if(!$request->has('id')){
                $validAttribute = request()->validate([
                    'office_ministry_id' => 'nullable|numeric',
                    'office_layer_id' => 'nullable|numeric',
                    'parent_office_id' => 'nullable|numeric',
                    'office_level' => 'required|numeric',
                    'office_sequence' => 'nullable|numeric',
                    'active_status' => 'nullable|numeric',
                    'geo_division_id' => 'nullable|numeric',
                    'geo_district_id' => 'nullable|numeric',
                    'geo_upazila_id' => 'nullable|numeric',
                    'geo_union_id' => 'nullable|numeric',
                    'office_name_eng' => 'required|nullable|string',
                    'office_name_bng' => 'required|nullable|string',
                    'office_address' => 'required|string',
                    'office_phone' => 'nullable|string',
                    'office_mobile' => 'nullable|numeric',
                    'office_fax' => 'nullable|numeric',
                    'office_email' => 'nullable|string',
                    'office_web' => 'required|string|unique:App\Models\Office,office_web,{$request->id}',
                    'office_status' => 'nullable|numeric',
                    'date_of_close' => 'nullable',
                    'date_of_formation' => 'nullable',
                    'actule_strenth' => 'nullable',
                    'office_description' => 'nullable',
                    'office_details' => 'nullable',
                    'office_document' => 'nullable',
                ]);
            }
            else{
                $validAttribute = request()->validate([
                    'office_ministry_id' => 'nullable|numeric',
                    'office_layer_id' => 'nullable|numeric',
                    'parent_office_id' => 'nullable|numeric',
                    'office_level' => 'required|numeric',
                    'office_sequence' => 'nullable|numeric',
                    'active_status' => 'nullable|numeric',
                    'geo_division_id' => 'nullable|numeric',
                    'geo_district_id' => 'nullable|numeric',
                    'geo_upazila_id' => 'nullable|numeric',
                    'geo_union_id' => 'nullable|numeric',
                    'office_name_eng' => 'required|string',
                    'office_name_bng' => 'required|string',
                    'office_address' => 'required|string',
                    'office_phone' => 'nullable|string',
                    'office_mobile' => 'nullable|numeric',
                    'office_fax' => 'nullable|numeric',
                    'office_email' => 'nullable|string',
                    'office_web' => 'required|string',
                    'office_status' => 'nullable|numeric',
                    'date_of_close' => 'nullable',
                    'date_of_formation' => 'nullable',
                    'actule_strenth' => 'nullable',
                    'office_description' => 'nullable',
                    'office_details' => 'nullable',
                    'office_document' => 'nullable',
                ]);
            }

            $createdBy = auth()->user()->id;

            //for office origin
            if($request->has('id')){
                $office_origin = OfficeOrigin::find($request->id);
            }else{
                $office_origin = new OfficeOrigin;
            }
            $office_origin->office_ministry_id = $request->office_ministry_id;
            $office_origin->office_layer_id = $request->office_layer_id;
            $office_origin->parent_office_id = $request->parent_office_id;
            $office_origin->office_name_eng = $request->office_name_eng;
            $office_origin->office_name_bng = $request->office_name_bng;
            $office_origin->office_level = $request->office_level;
            $office_origin->office_sequence = $request->office_sequence;
            $office_origin->created_by = $createdBy;
            $office_origin->modified_by = $createdBy;
            $office_origin->save();

            //for office
            if($request->has('id')){
                $office = Office::find($request->id);
            }else{
                $office = new  Office;
            }
            $office->id = $office_origin->id;
            $office->office_ministry_id = $request->office_ministry_id;
            $office->office_layer_id = $request->office_layer_id;
            $office->custom_layer_id = $request->office_layer_id;
            $office->office_origin_id = $office_origin->id;
            $office->parent_office_id = $request->parent_office_id;
            $office->geo_division_id = $request->geo_division_id;
            $office->geo_district_id =  $request->geo_district_id;
            $office->geo_upazila_id =  $request->geo_upazila_id;
            $office->geo_union_id =  $request->geo_union_id !=null ? $request->geo_union_id : 0;
            $office->office_name_eng =  $request->office_name_eng;
            $office->office_name_bng =  $request->office_name_bng;
            $office->office_address =  $request->office_address;
            $office->office_phone =  $request->office_phone;
            $office->office_mobile =  $request->office_mobile;
            $office->office_fax =  $request->office_fax;
            $office->office_email =  $request->office_email;
            $office->office_web =  $request->office_web;
            $office->date_of_formation = date('Y-m-d', strtotime($request->date_of_formation));
            $office->date_of_close = date('Y-m-d', strtotime($request->date_of_close));
            $office->office_status =  $request->office_status;
            $office->actual_strength =  $request->actual_strength;
            $office->office_description =  trim($request->office_description);
            $office->office_details =  trim($request->office_details);
            $office->created_by =  $createdBy;
            $office->modified_by =  $createdBy;
            $office->save();


            //for user
            if(!$request->has('id')){
                $user = new User();
                $user->username = $request->office_web;
                $user->password = Hash::make('123456');
                $user->user_alias = $request->office_web;
                $user->active = 1;
                $user->user_role_id = 3;
                $user->is_admin = 1;
                $user->user_status = 1;
                $user->modified_by = $createdBy;
                $user->is_email_verified = 0;
                $user->force_password_change = 0;
                $user->created_by = $createdBy;
                $user->save();

                //for user office
                $userOffice = new UserOffice();
                $userOffice->user_id  = $user->id;
                $userOffice->office_id = $office_origin->id;
                $userOffice->office_name_bn = $request->office_name_bng;
                $userOffice->office_name_en = $request->office_name_eng;
                $userOffice->status = 1;
                $userOffice->created_by = $createdBy;
                $userOffice->save();
            }

            //for insert attachment
            if ($request->hasFile('attachments')) {
                $attachments = array();
                foreach ($request->attachments as $attachment) {
                    $allowedExtension = ['pdf', 'jpg', 'jpeg', 'JPEG', 'png', 'pdf'];

                    $attachmentExtension = $attachment->getClientOriginalExtension();
                    $checkIsValid = in_array($attachmentExtension, $allowedExtension);
                    if ($checkIsValid) {
                        $uniqueAttachmentFileName = time() . uniqid(). '.' . $attachmentExtension;

                        $destinationPath = public_path('/documents/');
                        $attachment->move($destinationPath, $uniqueAttachmentFileName);

                        $attachments[] = array(
                            'document_type'=> 'office',
                            'relational_id'=> $office_origin->id,
                            'attachment_type'=> $attachmentExtension,
                            'file_custom_name'=> $uniqueAttachmentFileName,
                            'file_name'=> $uniqueAttachmentFileName,
                            'user_file_name'=> $attachment->getClientOriginalName(),
                            'file_dir'=> 'documents/'.$uniqueAttachmentFileName,
                            'created_by'=> $createdBy
                        );
                    }

                }
                if (!empty($attachments)) {
                    Document::insert($attachments);
                }
            }

            DB::commit();
            return response(['status' => 'success', 'msg' => 'সফল্ভাবে যুক্ত করা হয়েছে।']);
        }
        catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg' => $exception->errors(),
                'statusCode' => '422',
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response(['status' => 'error', 'msg' => 'যুক্ত করা সম্ভব হয়নি।', 'data' => $e]);
        }
    }
}
