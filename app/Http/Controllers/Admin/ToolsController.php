<?php

namespace App\Http\Controllers\Admin;

use App\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreToolsRequest;
use App\Http\Requests\Admin\UpdateToolsRequest;
use Yajra\DataTables\DataTables;

class ToolsController extends Controller
{
    /**
     * Display a listing of Tool.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($proj_id=null)
    {
        if (! Gate::allows('tool_access')) {
            return abort(401);
        }

        if (request()->ajax()) {
            $query = Tool::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

        if (! Gate::allows('tool_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'tools.id',
                'tools.name',
                'tools.project_id',
                'tools.publication_date',
                'tools.type_of_data_available',
                'tools.description',
                'tools.keywords',
                'tools.link',
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
                $gateKey  = 'tool_';
                $routeKey = 'admin.tools';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });
            $table->editColumn('publication_date', function ($row) {
                return $row->publication_date ? $row->publication_date : '';
            });
            $table->editColumn('type_of_data_available', function ($row) {
                return $row->type_of_data_available ? $row->type_of_data_available : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('keywords', function ($row) {
                return $row->keywords ? $row->keywords : '';
            });
            $table->editColumn('link', function ($row) {
                if($row->link) { return '<a href="'. $row->link .'" target="_blank">' . $row->link . '</a>'; };
            });

            $table->rawColumns(['actions','massDelete','link']);

            return $table->make(true);
        }

        $projects = \App\Project::all()->sortBy('name');
        $project_name = \App\Project::where('id',$proj_id)->value('name');
        return view('admin.tools.index', compact('projects','project_name'));
    }

    /**
     * Show the form for creating new Tool.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('tool_create')) {
            return abort(401);
        }

        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.tools.create', compact('projects'));
    }

    /**
     * Store a newly created Tool in storage.
     *
     * @param  \App\Http\Requests\StoreToolsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreToolsRequest $request)
    {
        if (! Gate::allows('tool_create')) {
            return abort(401);
        }
        $tool = Tool::create($request->all());



        return redirect()->route('admin.tools.index');
    }


    /**
     * Show the form for editing Tool.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('tool_edit')) {
            return abort(401);
        }

        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $tool = Tool::findOrFail($id);

        return view('admin.tools.edit', compact('tool', 'projects'));
    }

    /**
     * Update Tool in storage.
     *
     * @param  \App\Http\Requests\UpdateToolsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateToolsRequest $request, $id)
    {
        if (! Gate::allows('tool_edit')) {
            return abort(401);
        }
        $tool = Tool::findOrFail($id);
        $tool->update($request->all());



        return redirect()->route('admin.tools.index');
    }


    /**
     * Display Tool.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('tool_view')) {
            return abort(401);
        }
        $tool = Tool::findOrFail($id);

        return view('admin.tools.show', compact('tool'));
    }


    /**
     * Remove Tool from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('tool_delete')) {
            return abort(401);
        }
        $tool = Tool::findOrFail($id);
        $tool->delete();

        return redirect()->route('admin.tools.index');
    }

    /**
     * Delete all selected Tool at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('tool_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Tool::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Tool from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('tool_delete')) {
            return abort(401);
        }
        $tool = Tool::onlyTrashed()->findOrFail($id);
        $tool->restore();

        return redirect()->route('admin.tools.index');
    }

    /**
     * Permanently delete Tool from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('tool_delete')) {
            return abort(401);
        }
        $tool = Tool::onlyTrashed()->findOrFail($id);
        $tool->forceDelete();

        return redirect()->route('admin.tools.index');
    }
}
