<?php

namespace App\Services;

use App\Mail\UserLoginMail;
use App\Models\Document;
use App\Repository\Eloquent\OfficeRepository;
use App\Repository\Eloquent\UserOfficeRepository;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class OfficeService
{
    public function __construct(OfficeRepository $officeRepository, UserRepository $userRepository,
                                UserOfficeRepository $userOfficeRepository)
    {
        $this->officeRepository = $officeRepository;
        $this->userRepository = $userRepository;
        $this->userOfficeRepository = $userOfficeRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        DB::beginTransaction();

        try {
            //for office
            $officeId = $this->officeRepository->store($request, $cdesk);

            //for user
            $userId = $this->userRepository->store($request, $cdesk);

            //for user office
            $this->userOfficeRepository->storeUserOffice($request, $userId, $officeId, $cdesk);

            //for insert attachment
            if ($request->hasFile('attachments')) {
                $attachments = array();
                foreach ($request->attachments as $attachment) {
                    $allowedExtension = ['pdf', 'jpg', 'jpeg', 'JPEG', 'png', 'pdf'];

                    $attachmentExtension = $attachment->getClientOriginalExtension();
                    $checkIsValid = in_array($attachmentExtension, $allowedExtension);
                    if ($checkIsValid) {
                        $uniqueAttachmentFileName = time() . uniqid() . '.' . $attachmentExtension;

                        $destinationPath = public_path('/documents/');
                        $attachment->move($destinationPath, $uniqueAttachmentFileName);

                        $attachments[] = array(
                            'document_type' => 'office',
                            'relational_id' => $officeId,
                            'attachment_type' => $attachmentExtension,
                            'file_custom_name' => $uniqueAttachmentFileName,
                            'file_name' => $uniqueAttachmentFileName,
                            'user_file_name' => $attachment->getClientOriginalName(),
                            'file_dir' => 'documents/' . $uniqueAttachmentFileName,
                            'created_by' => $cdesk->officer_id,
                        );
                    }
                }
                if (!empty($attachments)) {
                    Document::insert($attachments);
                }
            }

            $details = [
                'username' => trim($request->office_web),
                'userEmail' => trim($request->office_email),
                'password' => '123456',
            ];
            $email = new UserLoginMail($details);
            Mail::to($request->office_email)->send($email);

            DB::commit();
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        }
        catch (ValidationException $exception) {
            $returnData = ['status' => 'error', 'data' => $exception->errors()];
        }
        catch (\Exception $exception) {
            DB::rollback();
            $returnData = ['status' => 'error', 'data' => $exception];
        }

        return $returnData;
    }


    public function update(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        DB::beginTransaction();

        try {
            $this->officeRepository->update($request, $cdesk);

            //for insert attachment
            if ($request->hasFile('attachments')) {
                $attachments = array();
                foreach ($request->attachments as $attachment) {
                    $allowedExtension = ['pdf', 'jpg', 'jpeg', 'JPEG', 'png', 'pdf'];

                    $attachmentExtension = $attachment->getClientOriginalExtension();
                    $checkIsValid = in_array($attachmentExtension, $allowedExtension);
                    if ($checkIsValid) {
                        $uniqueAttachmentFileName = time() . uniqid() . '.' . $attachmentExtension;

                        $destinationPath = public_path('/documents/');
                        $attachment->move($destinationPath, $uniqueAttachmentFileName);

                        $attachments[] = array(
                            'document_type' => 'office',
                            'relational_id' => $request->id,
                            'attachment_type' => $attachmentExtension,
                            'file_custom_name' => $uniqueAttachmentFileName,
                            'file_name' => $uniqueAttachmentFileName,
                            'user_file_name' => $attachment->getClientOriginalName(),
                            'file_dir' => 'documents/' . $uniqueAttachmentFileName,
                            'created_by' => $cdesk->officer_id,
                        );
                    }
                }
                if (!empty($attachments)) {
                    Document::insert($attachments);
                }
            }
            DB::commit();
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে হালনাগাদ করা হয়েছে।'];
        }
        catch (ValidationException $exception) {
            $returnData = ['status' => 'error', 'data' => $exception->errors()];
        }
        catch (\Exception $exception) {
            DB::rollback();
            $returnData = ['status' => 'error', 'data' => $exception];
        }

        return $returnData;
    }


    public function show(Request $request){
        try {
            $officeInfo = $this->officeRepository->show($request->id);
            return ['status' => 'success', 'data' => $officeInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function searchOffice(Request $request){
        try {
            $officeSearchList = $this->officeRepository->searchOffice($request);
            return ['status' => 'success', 'data' => $officeSearchList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function get_office_ministry_and_layer_wise(Request $request){
        try {
            $get_office_list = $this->officeRepository->get_office_ministry_and_layer_wise($request);
            return ['status' => 'success', 'data' => $get_office_list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function officeDatatable(Request $request){
        try {
            $officeList = $this->officeRepository->officeDatatable($request);
            return ['status' => 'success', 'data' => $officeList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
