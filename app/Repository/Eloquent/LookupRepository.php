<?php

namespace App\Repository\Eloquent;

use App\Models\Lookup;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LookupRepository implements BaseRepositoryInterface
{
    public function store(Request $request, $cdesk)
    {
        // TODO: Implement store() method.
    }

    public function update(Request $request, $cdesk)
    {
        // TODO: Implement update() method.
    }

    //show
    public function show($id)
    {
        // TODO: Implement update() method.
    }

    //delete
    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    //list
    public function list(Request $request)
    {
        // TODO: Implement delete() method.
    }

    public function getLookupTypeWise(Request $request)
    {
        return Lookup::where('lookup_type_id',$request->lookup_type_id)
            ->where('is_active',1)
            ->get()
            ->toArray();
    }
}
