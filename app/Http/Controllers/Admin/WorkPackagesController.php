<?php

namespace App\Http\Controllers\Admin;

use App\WorkPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorkPackagesRequest;
use App\Http\Requests\Admin\UpdateWorkPackagesRequest;
use Yajra\DataTables\DataTables;

class WorkPackagesController extends Controller
{
    /**
     * Display a listing of WorkPackage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($proj_id=null)
    {
        if (! Gate::allows('work_package_access')) {
            return abort(401);
        }

        if (request()->ajax()) {
            $query = WorkPackage::query();
            $query->with("name");
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

        if (! Gate::allows('work_package_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'work_packages.id',
                'work_packages.name_id',
                'work_packages.description',
                'work_packages.project_id',
            ]);

            $project_id = request('project_id');
            if( $project_id != null) {
              $query->where('project_id', $project_id)->get();
            }

            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'work_package_';
                $routeKey = 'admin.work_packages';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name.name', function ($row) {
                return $row->name ? $row->name->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        $projects = \App\Project::all()->sortBy('name');
        $project_name = \App\Project::where('id',$proj_id)->value('name');
        return view('admin.work_packages.index', compact('project_name', 'projects'));
    }

    /**
     * Show the form for creating new WorkPackage.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('work_package_create')) {
            return abort(401);
        }

        $names = \App\Wp::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.work_packages.create', compact('names', 'projects'));
    }

    /**
     * Store a newly created WorkPackage in storage.
     *
     * @param  \App\Http\Requests\StoreWorkPackagesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkPackagesRequest $request)
    {
        if (! Gate::allows('work_package_create')) {
            return abort(401);
        }
        $work_package = WorkPackage::create($request->all());



        return redirect()->route('admin.work_packages.index');
    }


    /**
     * Show the form for editing WorkPackage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('work_package_edit')) {
            return abort(401);
        }

        $names = \App\Wp::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $work_package = WorkPackage::findOrFail($id);

        return view('admin.work_packages.edit', compact('work_package', 'names', 'projects'));
    }

    /**
     * Update WorkPackage in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkPackagesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkPackagesRequest $request, $id)
    {
        if (! Gate::allows('work_package_edit')) {
            return abort(401);
        }
        $work_package = WorkPackage::findOrFail($id);
        $work_package->update($request->all());



        return redirect()->route('admin.work_packages.index');
    }


    /**
     * Display WorkPackage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('work_package_view')) {
            return abort(401);
        }

        $names = \App\Wp::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$deliverables = \App\Deliverable::where('wp_id', $id)->get();

        $work_package = WorkPackage::findOrFail($id);

        return view('admin.work_packages.show', compact('work_package', 'deliverables'));
    }


    /**
     * Remove WorkPackage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('work_package_delete')) {
            return abort(401);
        }
        $work_package = WorkPackage::findOrFail($id);
        $work_package->delete();

        return redirect()->route('admin.work_packages.index');
    }

    /**
     * Delete all selected WorkPackage at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('work_package_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = WorkPackage::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore WorkPackage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('work_package_delete')) {
            return abort(401);
        }
        $work_package = WorkPackage::onlyTrashed()->findOrFail($id);
        $work_package->restore();

        return redirect()->route('admin.work_packages.index');
    }

    /**
     * Permanently delete WorkPackage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('work_package_delete')) {
            return abort(401);
        }
        $work_package = WorkPackage::onlyTrashed()->findOrFail($id);
        $work_package->forceDelete();

        return redirect()->route('admin.work_packages.index');
    }
}
