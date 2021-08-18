<?php

namespace App\Repository\Eloquent;

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
        if ($request->per_page && !$request->all) {
            return OfficeMinistry::paginate($request->per_page);
        } else {
            return OfficeMinistry::all();
        }
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
