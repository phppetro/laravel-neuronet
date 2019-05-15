<?php

namespace App\Http\Controllers\Admin;

use App\Deliverable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverablesRequest;
use App\Http\Requests\Admin\UpdateDeliverablesRequest;
use Yajra\DataTables\DataTables;

class DeliverablesController extends Controller
{
    /**
     * Display a listing of Deliverable.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('deliverable_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Deliverable::query();
            $query->with("wp");
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'deliverables.id',
                'deliverables.label',
                'deliverables.title',
                'deliverables.wp_id',
                'deliverables.project_id',
                'deliverables.link',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'deliverable_';
                $routeKey = 'admin.deliverables';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('label', function ($row) {
                return $row->label ? $row->label : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('wp.description', function ($row) {
                return $row->wp ? $row->wp->description : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.deliverables.index');
    }

    /**
     * Show the form for creating new Deliverable.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('deliverable_create')) {
            return abort(401);
        }
        
        $wps = \App\WorkPackage::get()->pluck('description', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.deliverables.create', compact('wps', 'projects'));
    }

    /**
     * Store a newly created Deliverable in storage.
     *
     * @param  \App\Http\Requests\StoreDeliverablesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliverablesRequest $request)
    {
        if (! Gate::allows('deliverable_create')) {
            return abort(401);
        }
        $deliverable = Deliverable::create($request->all());



        return redirect()->route('admin.deliverables.index');
    }


    /**
     * Show the form for editing Deliverable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('deliverable_edit')) {
            return abort(401);
        }
        
        $wps = \App\WorkPackage::get()->pluck('description', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $deliverable = Deliverable::findOrFail($id);

        return view('admin.deliverables.edit', compact('deliverable', 'wps', 'projects'));
    }

    /**
     * Update Deliverable in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliverablesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliverablesRequest $request, $id)
    {
        if (! Gate::allows('deliverable_edit')) {
            return abort(401);
        }
        $deliverable = Deliverable::findOrFail($id);
        $deliverable->update($request->all());



        return redirect()->route('admin.deliverables.index');
    }


    /**
     * Display Deliverable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('deliverable_view')) {
            return abort(401);
        }
        $deliverable = Deliverable::findOrFail($id);

        return view('admin.deliverables.show', compact('deliverable'));
    }


    /**
     * Remove Deliverable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
        $deliverable = Deliverable::findOrFail($id);
        $deliverable->delete();

        return redirect()->route('admin.deliverables.index');
    }

    /**
     * Delete all selected Deliverable at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Deliverable::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Deliverable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
        $deliverable = Deliverable::onlyTrashed()->findOrFail($id);
        $deliverable->restore();

        return redirect()->route('admin.deliverables.index');
    }

    /**
     * Permanently delete Deliverable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
        $deliverable = Deliverable::onlyTrashed()->findOrFail($id);
        $deliverable->forceDelete();

        return redirect()->route('admin.deliverables.index');
    }
}
