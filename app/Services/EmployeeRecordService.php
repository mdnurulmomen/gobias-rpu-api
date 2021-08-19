<?php

namespace App\Services;

use App\Repository\Eloquent\EmployeeRecordRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmployeeRecordService
{

    public function __construct(EmployeeRecordRepository $employeeRecordRepository)
    {
        $this->employeeRecordRepository = $employeeRecordRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $employeeId = $this->employeeRecordRepository->store($request, $cdesk);
            $returnData = [
                'status' => 'success',
                'data' => [
                    'msg' => 'সফল্ভাবে যুক্ত করা হয়েছে।',
                    'employee_id' => $employeeId
                ],
            ];
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
            $this->employeeRecordRepository->update($request, $cdesk);
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
            $employeeInfo = $this->employeeRecordRepository->show($request->id);
            return ['status' => 'success', 'data' => $employeeInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function profile(Request $request){
        try {
            $employeeInfo = $this->employeeRecordRepository->profile($request->id);
            return ['status' => 'success', 'data' => $employeeInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function employeeDatatable(Request $request){
        try {
            $employeeList = $this->employeeRecordRepository->employeeDatatable($request);
            return ['status' => 'success', 'data' => $employeeList];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
