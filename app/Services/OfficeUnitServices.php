<?php

namespace App\Services;

use App\Models\Document;
use App\Repository\Eloquent\Of;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeUnitServices
{
    public function __construct(OfficeRepository $officeRepository, UserRepository $userRepository, UserOfficeRepository $userOfficeRepository)
    {
        $this->officeRepository = $officeRepository;
        $this->userRepository = $userRepository;
        $this->userOfficeRepository = $userOfficeRepository;
    }

    public function storeOffice(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        DB::beginTransaction();

        try {
            $office = $this->officeRepository->create($request, $cdesk);

            //for user
            $user = $this->userRepository->create($request, $cdesk);

            //for user office
            $user_office = $this->userOfficeRepository->create($user, $office, $cdesk);

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
                            'relational_id' => $office->id,
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
            $return_data = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        } catch (\Exception $exception) {
            DB::rollback();
            $return_data = ['status' => 'error', 'data' => $exception];
        }

        return $return_data;
    }
}
