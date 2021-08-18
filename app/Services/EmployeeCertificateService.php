<?php

namespace App\Services;

use App\Repository\Eloquent\EmployeeCertificateRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmployeeCertificateService
{
    public function __construct(EmployeeCertificateRepository $employeeCertificateRepository)
    {
        $this->employeeCertificateRepository = $employeeCertificateRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->employeeCertificateRepository->store($request, $cdesk);
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে যুক্ত করা হয়েছে।'];
        }
        catch (ValidationException $exception) {
            $returnData = ['status' => 'error', 'data' => $exception->errors()];
        }
        catch (\Exception $exception) {
            $returnData = ['status' => 'error', 'data' => $exception];
        }
        return $returnData;
    }

    public function update(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->employeeCertificateRepository->update($request, $cdesk);
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে হালনাগাদ করা হয়েছে।'];
        }
        catch (ValidationException $exception) {
            $returnData = ['status' => 'error', 'data' => $exception->errors()];
        }
        catch (\Exception $exception) {
            $returnData = ['status' => 'error', 'data' => $exception];
        }
        return $returnData;
    }

    public function show(Request $request){
        try {
            $employeeCertificateInfo = $this->employeeCertificateRepository->show($request->id);
            return ['status' => 'success', 'data' => $employeeCertificateInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getSingleEmployeeCertificateList(Request $request){
        try {
            $employeeCertificateList = $this->employeeCertificateRepository->getSingleEmployeeCertificateList($request);
            return ['status' => 'success', 'data' => $employeeCertificateList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function delete(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->employeeCertificateRepository->delete($request, $cdesk);
            $returnData = ['status' => 'success', 'data' => 'সফল্ভাবে মুছে ফেলা হয়েছে।'];
        }
        catch (ValidationException $exception) {
            $returnData = ['status' => 'error', 'data' => $exception->errors()];
        }
        catch (\Exception $exception) {
            $returnData = ['status' => 'error', 'data' => $exception];
        }
        return $returnData;
    }
}
