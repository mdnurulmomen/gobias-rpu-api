<?php

namespace App\Repository\Eloquent;

use App\Models\DirectorateMinistryMap;
use App\Models\OfficeMinistry;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class OfficeMinistryRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    public function update(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    public function show($ministry_id)
    {
       return OfficeMinistry::where('id',$ministry_id)->get()->toArray();
    }

    public function list(Request $request)
    {
        if ($request->has('all')) {
            return OfficeMinistry::all();
        }
        else {
            return DirectorateMinistryMap::select('id','directorate_id',
                'office_ministry_id','directorate_name_bn','directorate_name_en','audit_type')
                ->with(['ministry_list'])
                ->where('directorate_id',$request->directorate_id)
                ->first()
                ->toArray();
        }
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
