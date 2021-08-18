<?php

namespace App\Repository\Eloquent;

use App\Models\GeoDivision;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GeoDivisionRepository implements BaseRepositoryInterface
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

    public function list(Request $request)
    {
        if ($request->per_page && !$request->all) {
            return GeoDivision::paginate($request->per_page)->toArray();
        } else {
            return GeoDivision::all()->toArray();
        }
    }
}
