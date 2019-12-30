<?php

namespace App\Http\Controllers\Admin;

use App\DecisionTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDecisionToolsRequest;
use App\Http\Requests\Admin\UpdateDecisionToolsRequest;
use Yajra\DataTables\DataTables;

class DecisionToolsController extends Controller
{
    /**
     * Display a listing of DecisionTool.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('decision_tool_access')) {
            return abort(401);
        }



        if (request()->ajax()) {
            $query = DecisionTool::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

                if (! Gate::allows('decision_tool_delete')) {
                    return abort(401);
                }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'decision_tools.id',
                'decision_tools.title',
                'decision_tools.body',
                'decision_tools.target',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'decision_tool_';
                $routeKey = 'admin.decision_tools';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('body', function ($row) {
                return $row->body ? $row->body : '';
            });
            $table->editColumn('target', function ($row) {
                return $row->target ? $row->target : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.decision_tools.index');
    }

    /**
     * Show the form for creating new DecisionTool.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('decision_tool_create')) {
            return abort(401);
        }
        return view('admin.decision_tools.create');
    }

    /**
     * Store a newly created DecisionTool in storage.
     *
     * @param  \App\Http\Requests\StoreDecisionToolsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDecisionToolsRequest $request)
    {
        if (! Gate::allows('decision_tool_create')) {
            return abort(401);
        }
        $decision_tool = DecisionTool::create($request->all());



        return redirect()->route('admin.decision_tools.index');
    }


    /**
     * Show the form for editing DecisionTool.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('decision_tool_edit')) {
            return abort(401);
        }
        $decision_tool = DecisionTool::findOrFail($id);

        return view('admin.decision_tools.edit', compact('decision_tool'));
    }

    /**
     * Update DecisionTool in storage.
     *
     * @param  \App\Http\Requests\UpdateDecisionToolsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDecisionToolsRequest $request, $id)
    {
        if (! Gate::allows('decision_tool_edit')) {
            return abort(401);
        }
        $decision_tool = DecisionTool::findOrFail($id);
        $decision_tool->update($request->all());



        return redirect()->route('admin.decision_tools.index');
    }


    /**
     * Display DecisionTool.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('decision_tool_view')) {
            return abort(401);
        }
        $decision_tool = DecisionTool::findOrFail($id);

        return view('admin.decision_tools.show', compact('decision_tool'));
    }


    /**
     * Remove DecisionTool from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('decision_tool_delete')) {
            return abort(401);
        }
        $decision_tool = DecisionTool::findOrFail($id);
        $decision_tool->delete();

        return redirect()->route('admin.decision_tools.index');
    }

    /**
     * Delete all selected DecisionTool at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('decision_tool_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DecisionTool::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DecisionTool from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('decision_tool_delete')) {
            return abort(401);
        }
        $decision_tool = DecisionTool::onlyTrashed()->findOrFail($id);
        $decision_tool->restore();

        return redirect()->route('admin.decision_tools.index');
    }

    /**
     * Permanently delete DecisionTool from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('decision_tool_delete')) {
            return abort(401);
        }
        $decision_tool = DecisionTool::onlyTrashed()->findOrFail($id);
        $decision_tool->forceDelete();

        return redirect()->route('admin.decision_tools.index');
    }

    public function diagram()
    {
        $decision_tools = DecisionTool::all();
        return view('admin.decision_tool', compact('decision_tools'));
    }
}
