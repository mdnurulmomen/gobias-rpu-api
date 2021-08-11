<?php

namespace App\Repository\Eloquent;

use App\Models\OfficeUnit;
use App\Repository\Contracts\OfficeUnitRepositoryInterface;
use Illuminate\Http\Request;

class OfficeUnitRepository implements OfficeUnitRepositoryInterface
{

    public function update(Request $request, $cdesk)
    {
        $office_unit = OfficeUnit::find($request->id);
        $office_unit->unit_name_bng = $request->unit_name_bng;
        $office_unit->unit_name_eng = $request->unit_name_eng;
        $office_unit->save();
    }

}
