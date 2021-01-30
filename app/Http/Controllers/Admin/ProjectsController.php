<?php

namespace App\Http\Controllers\Admin;

use App\HighlightsMetric;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectsRequest;
use App\Http\Requests\Admin\UpdateProjectsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class ProjectsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (! Gate::allows('project_access')) {
//            return abort(401);
//        }



        if (request()->ajax()) {
            $query = Project::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

                if (! Gate::allows('project_delete')) {
                    return abort(401);
                }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'projects.id',
                'projects.name',
                'projects.description',
                'projects.objectives',
                'projects.website',
                'projects.start_date',
                'projects.end_date',
                'projects.logo',
            ])->Where('id', '!=', '24')->get();
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'project_';
                $routeKey = 'admin.projects';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('objectives', function ($row) {
                return $row->objectives ? $row->objectives : '';
            });
            $table->editColumn('website', function ($row) {
                if($row->website) { return '<a href="'. $row->website .'" target="_blank">' . $row->website . '</a>'; };
            });
            $table->editColumn('start_date', function ($row) {
                return $row->start_date ? $row->start_date : '';
            });
            $table->editColumn('end_date', function ($row) {
                return $row->end_date ? $row->end_date : '';
            });
            $table->editColumn('logo', function ($row) {
                if($row->logo) { return '<a href="'. asset(env('UPLOAD_PATH').'/img/' . $row->logo) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/img/thumb/' . $row->logo) .'"/>'; };
            });

            $table->rawColumns(['actions','massDelete','logo', 'website']);

            return $table->make(true);
        }

        return view('admin.projects.index');
    }

    /**
     * Show the form for creating new Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('project_create')) {
            return abort(401);
        }
        return view('admin.projects.create');
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param  \App\Http\Requests\StoreProjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectsRequest $request)
    {
        if (! Gate::allows('project_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $project = Project::create($request->all());

        $this->updateProjectsHighlights();

        return redirect()->route('admin.projects.index');
    }


    /**
     * Show the form for editing Project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('project_edit')) {
            return abort(401);
        }
        $project = Project::findOrFail($id);

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update Project in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectsRequest $request, $id)
    {
        if (! Gate::allows('project_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $project = Project::findOrFail($id);
        $project->update($request->all());

        $this->updateProjectsHighlights();

        return redirect()->route('admin.projects.index');
    }


    /**
     * Display Project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        if (! Gate::allows('project_view')) {
//            return abort(401);
//        }
        $partners = \App\Partner::whereHas('projects',
            function ($query) use ($id) {
                $query->where('id', $id);
            })->get();$tools = \App\Tool::where('project_id', $id)->get();$work_packages = \App\WorkPackage::where('project_id', $id)->get();$deliverables = \App\Deliverable::where('project_id', $id)->get();$activities = \App\Activity::where('project_id', $id)->get();$publications = \App\Publication::where('project_id', $id)->get();$assets = \App\AssetMap::where('project_id', $id)->get();$users = \App\User::where('project_id', $id)->get();$calendars = \App\Calendar::whereHas('projects',
        function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        $project = Project::findOrFail($id);

        return view('admin.projects.show', compact('project', 'partners', 'tools', 'work_packages', 'deliverables', 'activities', 'publications', 'assets', 'users', 'calendars'));
    }


    /**
     * Remove Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        $project = Project::findOrFail($id);
        $project->delete();

        $this->updateProjectsHighlights();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Delete all selected Project at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Project::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
        $this->updateProjectsHighlights();
    }


    /**
     * Restore Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        $this->updateProjectsHighlights();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Permanently delete Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        $this->updateProjectsHighlights();

        return redirect()->route('admin.projects.index');
    }

    public function updateProjectsHighlights()
    {
        $project_count = Project::all()->count() -2; // -1 because we don't want to count Neuronet in the total number.
        $highlight_metric = HighlightsMetric::findOrFail(1);
        $highlight_metric->update(['number'=>$project_count]);
    }
}
