<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreActivitiesRequest;
use App\Http\Requests\Admin\UpdateActivitiesRequest;
use Yajra\DataTables\DataTables;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of Activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('activity_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Activity::query();
            $query->with("user");
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('activity_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'activities.id',
                'activities.user_id',
                'activities.date',
                'activities.body',
                'activities.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'activity_';
                $routeKey = 'admin.activities';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('user.name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : '';
            });
            $table->editColumn('body', function ($row) {
                return $row->body ? $row->body : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.activities.index');
    }

    /**
     * Show the form for creating new Activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('activity_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.activities.create', compact('users', 'projects'));
    }

    /**
     * Store a newly created Activity in storage.
     *
     * @param  \App\Http\Requests\StoreActivitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivitiesRequest $request)
    {
        if (! Gate::allows('activity_create')) {
            return abort(401);
        }
        $activity = Activity::create($request->all());



        return redirect()->route('admin.activities.index');
    }


    /**
     * Show the form for editing Activity.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('activity_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $activity = Activity::findOrFail($id);

        return view('admin.activities.edit', compact('activity', 'users', 'projects'));
    }

    /**
     * Update Activity in storage.
     *
     * @param  \App\Http\Requests\UpdateActivitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivitiesRequest $request, $id)
    {
        if (! Gate::allows('activity_edit')) {
            return abort(401);
        }
        $activity = Activity::findOrFail($id);
        $activity->update($request->all());



        return redirect()->route('admin.activities.index');
    }


    /**
     * Display Activity.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('activity_view')) {
            return abort(401);
        }
        $activity = Activity::findOrFail($id);

        return view('admin.activities.show', compact('activity'));
    }


    /**
     * Remove Activity from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('activity_delete')) {
            return abort(401);
        }
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('admin.activities.index');
    }

    /**
     * Delete all selected Activity at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('activity_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Activity::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Activity from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('activity_delete')) {
            return abort(401);
        }
        $activity = Activity::onlyTrashed()->findOrFail($id);
        $activity->restore();

        return redirect()->route('admin.activities.index');
    }

    /**
     * Permanently delete Activity from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('activity_delete')) {
            return abort(401);
        }
        $activity = Activity::onlyTrashed()->findOrFail($id);
        $activity->forceDelete();

        return redirect()->route('admin.activities.index');
    }
}
