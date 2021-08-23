<?php

namespace App\Repository\Eloquent;

use App\Models\RpInfoSectionEn;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class RpInfoSectionEnRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $rp_id)
    {
        $rp_info_section_data_en = $request->info_section_data_en;

        foreach ($request->rp_info_section_id as $key => $value){
            $rp_info_section_bn = new RpInfoSectionEn;
            $rp_info_section_bn->rp_id = $rp_id;
            $rp_info_section_bn->info_year_id = $request->info_year_id;
            $rp_info_section_bn->rp_info_section_id = $value;
            $rp_info_section_bn->info_type = 1;
            $rp_info_section_bn->info_section_data = $rp_info_section_data_en[$key];
            $rp_info_section_bn->save();
        }
    }

    public function update(Request $request, $cdesk)
    {

    }

    public function show($responsible_party_id)
    {

    }

    public function list(Request $request)
    {

    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
