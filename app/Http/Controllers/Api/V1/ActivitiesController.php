<?php

namespace App\Http\Controllers\Api\V1;

use App\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreActivitiesRequest;
use App\Http\Requests\Admin\UpdateActivitiesRequest;
use Yajra\DataTables\DataTables;

class ActivitiesController extends Controller
{
    public function index()
    {
        return Activity::all();
    }

    public function show($id)
    {
        return Activity::findOrFail($id);
    }

    public function update(UpdateActivitiesRequest $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update($request->all());
        

        return $activity;
    }

    public function store(StoreActivitiesRequest $request)
    {
        $activity = Activity::create($request->all());
        

        return $activity;
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return '';
    }
}
