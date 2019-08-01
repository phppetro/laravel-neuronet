<?php

namespace App\Http\Controllers\Admin;

use App\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCalendarsRequest;
use App\Http\Requests\Admin\UpdateCalendarsRequest;
use Yajra\DataTables\DataTables;

class CalendarsController extends Controller
{
    /**
     * Display a listing of Calendar.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('calendar_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Calendar::query();
            $query->with("project");
            $query->with("color");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('calendar_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'calendars.id',
                'calendars.title',
                'calendars.project_id',
                'calendars.location',
                'calendars.start_date',
                'calendars.end_date',
                'calendars.color_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'calendar_';
                $routeKey = 'admin.calendars';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });
            $table->editColumn('start_date', function ($row) {
                return $row->start_date ? $row->start_date : '';
            });
            $table->editColumn('end_date', function ($row) {
                return $row->end_date ? $row->end_date : '';
            });
            $table->editColumn('color.color', function ($row) {
                return $row->color ? $row->color->color : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.calendars.index');
    }

    /**
     * Show the form for creating new Calendar.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('calendar_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $colors = \App\Color::get()->pluck('color', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.calendars.create', compact('projects', 'colors'));
    }

    /**
     * Store a newly created Calendar in storage.
     *
     * @param  \App\Http\Requests\StoreCalendarsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalendarsRequest $request)
    {
        if (! Gate::allows('calendar_create')) {
            return abort(401);
        }
        $calendar = Calendar::create($request->all());



        return redirect()->route('admin.calendars.index');
    }


    /**
     * Show the form for editing Calendar.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('calendar_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $colors = \App\Color::get()->pluck('color', 'id')->prepend(trans('global.app_please_select'), '');

        $calendar = Calendar::findOrFail($id);

        return view('admin.calendars.edit', compact('calendar', 'projects', 'colors'));
    }

    /**
     * Update Calendar in storage.
     *
     * @param  \App\Http\Requests\UpdateCalendarsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCalendarsRequest $request, $id)
    {
        if (! Gate::allows('calendar_edit')) {
            return abort(401);
        }
        $calendar = Calendar::findOrFail($id);
        $calendar->update($request->all());



        return redirect()->route('admin.calendars.index');
    }


    /**
     * Display Calendar.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('calendar_view')) {
            return abort(401);
        }
        $calendar = Calendar::findOrFail($id);

        return view('admin.calendars.show', compact('calendar'));
    }


    /**
     * Remove Calendar from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('calendar_delete')) {
            return abort(401);
        }
        $calendar = Calendar::findOrFail($id);
        $calendar->delete();

        return redirect()->route('admin.calendars.index');
    }

    /**
     * Delete all selected Calendar at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('calendar_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Calendar::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Calendar from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('calendar_delete')) {
            return abort(401);
        }
        $calendar = Calendar::onlyTrashed()->findOrFail($id);
        $calendar->restore();

        return redirect()->route('admin.calendars.index');
    }

    /**
     * Permanently delete Calendar from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('calendar_delete')) {
            return abort(401);
        }
        $calendar = Calendar::onlyTrashed()->findOrFail($id);
        $calendar->forceDelete();

        return redirect()->route('admin.calendars.index');
    }
}
