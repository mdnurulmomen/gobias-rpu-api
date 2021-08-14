<?php

namespace App\Repository\Eloquent;

use App\Models\OfficeCustomLayer;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class OfficeCustomLayerRepository implements BaseRepositoryInterface
{

    //create
    public function store(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    //update
    public function update(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    //show
    public function show($officeLayerId)
    {
        // TODO: Implement delete() method.
    }

    //list
    public function list(Request $request)
    {
        if ($request->per_page && !$request->all) {
            return OfficeCustomLayer::paginate($request->per_page)->toArray();
        } else {
            return OfficeCustomLayer::all()->toArray();
        }
    }

    //delete
    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
