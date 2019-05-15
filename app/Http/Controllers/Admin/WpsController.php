<?php

namespace App\Http\Controllers\Admin;

use App\Wp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWpsRequest;
use App\Http\Requests\Admin\UpdateWpsRequest;
use Yajra\DataTables\DataTables;

class WpsController extends Controller
{
    /**
     * Display a listing of Wp.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('wp_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Wp::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('wp_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'wps.id',
                'wps.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'wp_';
                $routeKey = 'admin.wps';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.wps.index');
    }

    /**
     * Show the form for creating new Wp.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('wp_create')) {
            return abort(401);
        }
        return view('admin.wps.create');
    }

    /**
     * Store a newly created Wp in storage.
     *
     * @param  \App\Http\Requests\StoreWpsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWpsRequest $request)
    {
        if (! Gate::allows('wp_create')) {
            return abort(401);
        }
        $wp = Wp::create($request->all());



        return redirect()->route('admin.wps.index');
    }


    /**
     * Show the form for editing Wp.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('wp_edit')) {
            return abort(401);
        }
        $wp = Wp::findOrFail($id);

        return view('admin.wps.edit', compact('wp'));
    }

    /**
     * Update Wp in storage.
     *
     * @param  \App\Http\Requests\UpdateWpsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWpsRequest $request, $id)
    {
        if (! Gate::allows('wp_edit')) {
            return abort(401);
        }
        $wp = Wp::findOrFail($id);
        $wp->update($request->all());



        return redirect()->route('admin.wps.index');
    }


    /**
     * Display Wp.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('wp_view')) {
            return abort(401);
        }
        $work_packages = \App\WorkPackage::where('name_id', $id)->get();

        $wp = Wp::findOrFail($id);

        return view('admin.wps.show', compact('wp', 'work_packages'));
    }


    /**
     * Remove Wp from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('wp_delete')) {
            return abort(401);
        }
        $wp = Wp::findOrFail($id);
        $wp->delete();

        return redirect()->route('admin.wps.index');
    }

    /**
     * Delete all selected Wp at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('wp_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Wp::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Wp from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('wp_delete')) {
            return abort(401);
        }
        $wp = Wp::onlyTrashed()->findOrFail($id);
        $wp->restore();

        return redirect()->route('admin.wps.index');
    }

    /**
     * Permanently delete Wp from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('wp_delete')) {
            return abort(401);
        }
        $wp = Wp::onlyTrashed()->findOrFail($id);
        $wp->forceDelete();

        return redirect()->route('admin.wps.index');
    }
}
