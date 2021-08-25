<?php

namespace App\Repository\Eloquent;

use App\Models\Language;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LanguageRepository implements BaseRepositoryInterface
{
    //store
    public function store(Request $request, $cdesk)
    {
        // TODO: Implement store() method.
    }

    //update
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
        return Language::all()->toArray();
    }
}
