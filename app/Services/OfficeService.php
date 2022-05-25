<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Office;
use App\Repository\Eloquent\CostCenterRepository;
use App\Repository\Eloquent\OfficeDetailRepository;
use App\Repository\Eloquent\OfficeRepository;
use App\Repository\Eloquent\RpInfoSectionBnRepository;
use App\Repository\Eloquent\RpInfoSectionEnRepository;
use App\Repository\Eloquent\RpInfoSectionRepository;
use App\Repository\Eloquent\UserOfficeRepository;
use App\Repository\Eloquent\UserRepository;
use App\Traits\SendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OfficeService
{
    use SendNotification;

    public function __construct(OfficeRepository          $officeRepository, UserRepository $userRepository,
                                UserOfficeRepository      $userOfficeRepository, RpInfoSectionBnRepository $rpInfoSectionBnRepository,
                                RpInfoSectionEnRepository $rpInfoSectionEnRepository, RpInfoSectionRepository $rpInfoSectionRepository, CostCenterRepository $costCenterRepository)
    {
        $this->officeRepository = $officeRepository;
        $this->userRepository = $userRepository;
        $this->userOfficeRepository = $userOfficeRepository;
        $this->rpInfoSectionBnRepository = $rpInfoSectionBnRepository;
        $this->rpInfoSectionEnRepository = $rpInfoSectionEnRepository;
        $this->rpInfoSectionRepository = $rpInfoSectionRepository;
        $this->costCenterRepository = $costCenterRepository;
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

            //cost center
            $this->costCenterRepository->store($request, $officeId);

            //for section
            if (!is_null($request->rp_info_section_id[0])) {
                $this->rpInfoSectionRepository->store($request, $officeId);
            }

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
            ];
//            $email = new UserLoginMail($details);
//            Mail::to($request->office_email)->send($email);

            $this->sendMailNotification(config('notifiable_constants.user_create'), $request->office_email, 'লগইনের তথ্য', $details);

            DB::commit();
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        } catch (ValidationException $exception) {
            $returnData = ['status' => 'error', 'data' => $exception->errors()];
        } catch (\Exception $exception) {
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
            //for office
            $this->officeRepository->update($request, $cdesk);
            $this->costCenterRepository->update($request);
            if (!is_null($request->rp_info_section_id[0])) {
                $this->rpInfoSectionBnRepository->delete($request, $cdesk);
                $this->rpInfoSectionEnRepository->delete($request, $cdesk);
                $this->rpInfoSectionRepository->store($request, $request->id);
            }

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
        } catch (ValidationException $exception) {
            $returnData = ['status' => 'error', 'data' => $exception->errors()];
        } catch (\Exception $exception) {
            DB::rollback();
            $returnData = ['status' => 'error', 'data' => $exception];
        }

        return $returnData;
    }


    public function show(Request $request)
    {
        try {
            $officeInfo = $this->officeRepository->show($request);
            return ['status' => 'success', 'data' => $officeInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function searchOffice(Request $request)
    {
        try {
            $officeSearchList = $this->officeRepository->searchOffice($request);
            return ['status' => 'success', 'data' => $officeSearchList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function get_office_ministry_and_layer_wise(Request $request)
    {
        /*try {
            $get_office_list = $this->officeRepository->get_office_ministry_and_layer_wise($request);
            return ['status' => 'success', 'data' => $get_office_list];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }*/

        $get_office_list = $this->officeRepository->get_office_ministry_and_layer_wise($request);
        return ['status' => 'success', 'data' => $get_office_list];
    }

    public function get_entity_office_ministry_wise(Request $request)
    {
        $get_office_list = $this->officeRepository->get_entity_office_ministry_wise($request);
        return ['status' => 'success', 'data' => $get_office_list];
    }

    public function get_ministry_parent_wise_child_office(Request $request)
    {
        $get_office_list = $this->officeRepository->get_ministry_parent_wise_child_office($request);
        return ['status' => 'success', 'data' => $get_office_list];
    }


    public function get_master_office_ministry_and_layer_wise(Request $request)
    {

        $get_office_list = $this->officeRepository->get_master_office_ministry_and_layer_wise($request);
        return ['status' => 'success', 'data' => $get_office_list];
    }

    public function get_office_parent_wise(Request $request)
    {

        $get_office_list = $this->officeRepository->get_office_parent_wise($request);
        return ['status' => 'success', 'data' => $get_office_list];
    }

    public function get_parent_wise_child_master_office(Request $request)
    {

        $get_office_list = $this->officeRepository->get_parent_wise_child_master_office($request);
        return ['status' => 'success', 'data' => $get_office_list];
    }

    public function get_parent_wise_child_office(Request $request)
    {

        $get_office_list = $this->officeRepository->get_parent_wise_child_office($request);
        return ['status' => 'success', 'data' => $get_office_list];
    }

    public function get_parent_with_child_office(Request $request)
    {

        $get_office_list = $this->officeRepository->get_parent_with_child_office($request);
        return ['status' => 'success', 'data' => $get_office_list];
    }

    public function officeDatatable(Request $request)
    {
        try {
            $officeList = $this->officeRepository->officeDatatable($request);
            return ['status' => 'success', 'data' => $officeList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function officeExport(Request $request)
    {
        try {
            $officeList = $this->officeRepository->officeExport($request);
            return ['status' => 'success', 'data' => $officeList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function parents(Request $request)
    {
        try {
            $officList = $this->officeRepository->parents($request);
            return ['status' => 'success', 'data' => $officList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function ministryWiseEntity(Request $request)
    {
        try {
            $officEntityList = $this->officeRepository->ministryWiseEntity($request);
            return ['status' => 'success', 'data' => $officEntityList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function ministryWiseOffice(Request $request)
    {
        try {
            $officList = $this->officeRepository->ministryWiseOffice($request);
            return ['status' => 'success', 'data' => $officList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    //office group
    public function getEntityWiseUnitGroupOffice(Request $request)
    {
        try {
            $officeList = $this->officeRepository->getEntityWiseUnitGroupOffice($request);
            return ['status' => 'success', 'data' => $officeList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getEntityOrUnitGroupWiseCostCenter(Request $request)
    {
        try {
            $officeList = $this->officeRepository->getEntityOrUnitGroupWiseCostCenter($request);
            return ['status' => 'success', 'data' => $officeList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }


    public function delete(Request $request)
    {
        try {
            $delete = $this->officeRepository->delete($request);
            return ['status' => 'success', 'data' => $delete];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getOfficesInfo(Request $request): array
    {
        try {
            $office_ids = explode(',', $request->office_ids);
            if (!is_array($office_ids)) {
                throw new \Exception('Office Ids error!');
            }
            $officeList = Office::whereIn('id', $office_ids)->select(
                'id',
                'geo_division_id',
                'geo_district_id',
                'office_ministry_id',
                'geo_upazila_id',
                'geo_union_id',
                'office_layer_id',
                'custom_layer_id',
                'office_name_bng',
                'office_name_eng',
                'office_address',
                'office_phone',
                'office_mobile',
                'office_email',
                'office_web',
                'last_audit_year_start',
                'last_audit_year_end',
                'risk_category',
                'parent_office_id',
                'office_type',
                'date_of_close',
                'office_status'
            )->get();
            return ['status' => 'success', 'data' => $officeList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getRelatedOffices(Request $request): array
    {
        try {
            $office_ids = explode(',', $request->office_ids);
            if (!is_array($office_ids)) {
                throw new \Exception('Office Ids error!');
            }
            $officeList = Office::whereIn('id', $office_ids);

            if ($request->type == 'both') {
                $officeList = $officeList->with('parent')->with('child');
            } elseif ($request->type == 'parent') {
                $officeList = $officeList->with('parent');
            } elseif ($request->type == 'child') {
                $officeList = $officeList->with('child');
            }

            $officeList = $officeList->get();

            return ['status' => 'success', 'data' => $officeList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }

    }
}
