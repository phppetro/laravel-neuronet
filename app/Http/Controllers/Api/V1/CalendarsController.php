<?php

namespace App\Http\Controllers\Api\V1;

use App\Calendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCalendarsRequest;
use App\Http\Requests\Admin\UpdateCalendarsRequest;
use Yajra\DataTables\DataTables;

class CalendarsController extends Controller
{
    public function index()
    {
        return Calendar::all();
    }

    public function show($id)
    {
        return Calendar::findOrFail($id);
    }

    public function update(UpdateCalendarsRequest $request, $id)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar->update($request->all());
        

        return $calendar;
    }

    public function store(StoreCalendarsRequest $request)
    {
        $calendar = Calendar::create($request->all());
        

        return $calendar;
    }

    public function destroy($id)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar->delete();
        return '';
    }
}
