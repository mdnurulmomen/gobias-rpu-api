<?php

namespace App\Services;

use App\Repository\Eloquent\EmployeeTrainingRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmployeeTrainingService
{
    public function __construct(EmployeeTrainingRepository $employeeTrainingRepository)
    {
        $this->employeeTrainingRepository = $employeeTrainingRepository;
    }

    public function store(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->employeeTrainingRepository->store($request, $cdesk);
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
            $this->employeeTrainingRepository->update($request, $cdesk);
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
            $employeeTrainingInfo = $this->employeeTrainingRepository->show($request->id);
            return ['status' => 'success', 'data' => $employeeTrainingInfo];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function getSingleEmployeeTrainingList(Request $request){
        try {
            $singleEmployeeTrainingDetails = $this->employeeTrainingRepository->getSingleEmployeeTrainingList($request);
            return ['status' => 'success', 'data' => $singleEmployeeTrainingDetails];
        } catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }

    public function delete(Request $request): array
    {
        $cdesk = json_decode($request->cdesk, false);
        try {
            $this->employeeTrainingRepository->delete($request, $cdesk);
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
