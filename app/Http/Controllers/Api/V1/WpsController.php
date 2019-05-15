<?php

namespace App\Http\Controllers\Api\V1;

use App\Wp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWpsRequest;
use App\Http\Requests\Admin\UpdateWpsRequest;
use Yajra\DataTables\DataTables;

class WpsController extends Controller
{
    public function index()
    {
        return Wp::all();
    }

    public function show($id)
    {
        return Wp::findOrFail($id);
    }

    public function update(UpdateWpsRequest $request, $id)
    {
        $wp = Wp::findOrFail($id);
        $wp->update($request->all());
        

        return $wp;
    }

    public function store(StoreWpsRequest $request)
    {
        $wp = Wp::create($request->all());
        

        return $wp;
    }

    public function destroy($id)
    {
        $wp = Wp::findOrFail($id);
        $wp->delete();
        return '';
    }
}
