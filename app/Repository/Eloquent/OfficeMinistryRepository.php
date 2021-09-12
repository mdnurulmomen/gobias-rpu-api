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
            /*return OfficeMinistry::with()
                ->where('directorate_id',19) //$request->directorate_id
                ->get()
                ->toArray();*/

            return \DB::table('office_ministries')
                ->select('office_ministries.id','office_ministries.name_eng',
                    'office_ministries.name_bng')
                ->leftJoin('directorate_ministry_maps','office_ministries.id',"=",'directorate_ministry_maps.office_ministry_id')
                ->where('directorate_ministry_maps.directorate_id',$request->directorate_id)
                ->get()
                ->toArray();

            /*return DirectorateMinistryMap::select('id','directorate_id',
                'office_ministry_id','directorate_name_bn','directorate_name_en','audit_type')
                ->with(['ministry_list'])
                ->where('directorate_id',$request->directorate_id) //$request->directorate_id
                ->get()
                ->groupBy('directorate_id')
                ->toArray();*/
        }
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
