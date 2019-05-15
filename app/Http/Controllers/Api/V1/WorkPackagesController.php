<?php

namespace App\Http\Controllers\Api\V1;

use App\WorkPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorkPackagesRequest;
use App\Http\Requests\Admin\UpdateWorkPackagesRequest;
use Yajra\DataTables\DataTables;

class WorkPackagesController extends Controller
{
    public function index()
    {
        return WorkPackage::all();
    }

    public function show($id)
    {
        return WorkPackage::findOrFail($id);
    }

    public function update(UpdateWorkPackagesRequest $request, $id)
    {
        $work_package = WorkPackage::findOrFail($id);
        $work_package->update($request->all());
        

        return $work_package;
    }

    public function store(StoreWorkPackagesRequest $request)
    {
        $work_package = WorkPackage::create($request->all());
        

        return $work_package;
    }

    public function destroy($id)
    {
        $work_package = WorkPackage::findOrFail($id);
        $work_package->delete();
        return '';
    }
}
