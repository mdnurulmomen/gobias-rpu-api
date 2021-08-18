<?php

namespace App\Services;

use App\Repository\Eloquent\EmployeeEducationalRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmployeeEducationalService
{
    public function __construct(EmployeeEducationalRepository $employeeEducationalRepository)
    {
        $this->employeeEducationalRepository = $employeeEducationalRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->employeeEducationalRepository->store($request, $cdesk);
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
            $this->employeeEducationalRepository->update($request, $cdesk);
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
            $employeeEducationalInfo = $this->employeeEducationalRepository->show($request->id);
            return ['status' => 'success', 'data' => $employeeEducationalInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getSingleEmployeeEducationList(Request $request){
        try {
            $allEducationalDetails = $this->employeeEducationalRepository->getSingleEmployeeEducationList($request);
            return ['status' => 'success', 'data' => $allEducationalDetails];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function delete(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->employeeEducationalRepository->delete($request, $cdesk);
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
