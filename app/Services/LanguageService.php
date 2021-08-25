<?php

namespace App\Services;

use App\Repository\Eloquent\LanguageRepository;
use Illuminate\Http\Request;

class LanguageService
{
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function list(Request $request){
        try {
            $languageList = $this->languageRepository->list($request);
            return ['status' => 'success', 'data' => $languageList];
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'data' => $e];
        }
    }
}
