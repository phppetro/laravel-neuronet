<?php

namespace App\Http\Controllers\Api\V1;

use App\Deliverable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverablesRequest;
use App\Http\Requests\Admin\UpdateDeliverablesRequest;
use Yajra\DataTables\DataTables;

class DeliverablesController extends Controller
{
    public function index()
    {
        return Deliverable::all();
    }

    public function show($id)
    {
        return Deliverable::findOrFail($id);
    }

    public function update(UpdateDeliverablesRequest $request, $id)
    {
        $deliverable = Deliverable::findOrFail($id);
        $deliverable->update($request->all());
        

        return $deliverable;
    }

    public function store(StoreDeliverablesRequest $request)
    {
        $deliverable = Deliverable::create($request->all());
        

        return $deliverable;
    }

    public function destroy($id)
    {
        $deliverable = Deliverable::findOrFail($id);
        $deliverable->delete();
        return '';
    }
}
