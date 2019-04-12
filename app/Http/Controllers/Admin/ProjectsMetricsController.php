<?php

namespace App\Http\Controllers\Admin;

use App\ProjectsMetric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectsMetricsRequest;
use App\Http\Requests\Admin\UpdateProjectsMetricsRequest;
use Yajra\DataTables\DataTables;

class ProjectsMetricsController extends Controller
{
    /**
     * Display a listing of ProjectsMetric.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('projects_metric_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ProjectsMetric::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('projects_metric_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'projects_metrics.id',
                'projects_metrics.name',
                'projects_metrics.funding',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'projects_metric_';
                $routeKey = 'admin.projects_metrics';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('funding', function ($row) {
                return $row->funding ? $row->funding : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.projects_metrics.index');
    }

    /**
     * Show the form for creating new ProjectsMetric.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('projects_metric_create')) {
            return abort(401);
        }
        return view('admin.projects_metrics.create');
    }

    /**
     * Store a newly created ProjectsMetric in storage.
     *
     * @param  \App\Http\Requests\StoreProjectsMetricsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectsMetricsRequest $request)
    {
        if (! Gate::allows('projects_metric_create')) {
            return abort(401);
        }
        $projects_metric = ProjectsMetric::create($request->all());



        return redirect()->route('admin.projects_metrics.index');
    }


    /**
     * Show the form for editing ProjectsMetric.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('projects_metric_edit')) {
            return abort(401);
        }
        $projects_metric = ProjectsMetric::findOrFail($id);

        return view('admin.projects_metrics.edit', compact('projects_metric'));
    }

    /**
     * Update ProjectsMetric in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectsMetricsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectsMetricsRequest $request, $id)
    {
        if (! Gate::allows('projects_metric_edit')) {
            return abort(401);
        }
        $projects_metric = ProjectsMetric::findOrFail($id);
        $projects_metric->update($request->all());



        return redirect()->route('admin.projects_metrics.index');
    }


    /**
     * Display ProjectsMetric.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('projects_metric_view')) {
            return abort(401);
        }
        $projects_metric = ProjectsMetric::findOrFail($id);

        return view('admin.projects_metrics.show', compact('projects_metric'));
    }


    /**
     * Remove ProjectsMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('projects_metric_delete')) {
            return abort(401);
        }
        $projects_metric = ProjectsMetric::findOrFail($id);
        $projects_metric->delete();

        return redirect()->route('admin.projects_metrics.index');
    }

    /**
     * Delete all selected ProjectsMetric at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('projects_metric_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProjectsMetric::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ProjectsMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('projects_metric_delete')) {
            return abort(401);
        }
        $projects_metric = ProjectsMetric::onlyTrashed()->findOrFail($id);
        $projects_metric->restore();

        return redirect()->route('admin.projects_metrics.index');
    }

    /**
     * Permanently delete ProjectsMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('projects_metric_delete')) {
            return abort(401);
        }
        $projects_metric = ProjectsMetric::onlyTrashed()->findOrFail($id);
        $projects_metric->forceDelete();

        return redirect()->route('admin.projects_metrics.index');
    }
}
