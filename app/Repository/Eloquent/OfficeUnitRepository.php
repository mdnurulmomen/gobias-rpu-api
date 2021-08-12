<?php

namespace App\Repository\Eloquent;

use App\Models\OfficeUnit;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class OfficeUnitRepository implements BaseRepositoryInterface
{

    public function update(Request $request, $cdesk)
    {
        $office_unit = OfficeUnit::find($request->id);
        $office_unit->office_ministry_id = $request->office_ministry_id;
        $office_unit->office_layer_id = $request->office_layer_id;
        $office_unit->office_id = $request->office_id;
        $office_unit->unit_name_bng = $request->unit_name_bng;
        $office_unit->unit_name_eng = $request->unit_name_eng;
        $office_unit->save();
    }

    public function store(Request $request, $cdesk)
    {
        // TODO: Implement store() method.
    }

    public function show(Request $request)
    {
        // TODO: Implement show() method.
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
