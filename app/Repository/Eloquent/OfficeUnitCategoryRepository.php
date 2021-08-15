<?php

namespace App\Repository\Eloquent;

use App\Models\OfficeUnitCategory;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class OfficeUnitCategoryRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {

    }

    public function update(Request $request, $cdesk)
    {

    }

    public function show($unit_category_id)
    {
       return OfficeUnitCategory::where('id',$unit_category_id)->get()->toArray();
    }

    public function list(Request $request)
    {
        if ($request->per_page && !$request->all) {
            return OfficeUnitCategory::paginate($request->per_page);
        } else {
            return OfficeUnitCategory::get()->toArray();
        }
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
