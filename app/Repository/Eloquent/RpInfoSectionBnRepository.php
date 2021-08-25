<?php

namespace App\Repository\Eloquent;

use App\Models\RpInfoSectionBn;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class RpInfoSectionBnRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $office_id)
    {
        $rp_info_section_data_bn = $request->info_section_data_bn;

        foreach ($request->rp_info_section_id as $key => $value){
            $rp_info_section_bn = new RpInfoSectionBn;
            $rp_info_section_bn->rp_id = 0;
            $rp_info_section_bn->office_id = $office_id;
            $rp_info_section_bn->info_year_id = $request->info_year_id;
            $rp_info_section_bn->rp_info_section_id = $value;
            $rp_info_section_bn->info_type = 1;
            $rp_info_section_bn->info_section_data = $rp_info_section_data_bn[$key];
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
