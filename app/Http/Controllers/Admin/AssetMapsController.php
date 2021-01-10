<?php

namespace App\Http\Controllers\Admin;

use App\AssetMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAssetMapsRequest;
use App\Http\Requests\Admin\UpdateAssetMapsRequest;
use Yajra\DataTables\DataTables;

class AssetMapsController extends Controller
{
    /**
     * Display a listing of AssetMaps.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (! Gate::allows('asset_map_access')) {
//            return abort(401);
//        }



        if (request()->ajax()) {
            $query = AssetMap::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

                if (! Gate::allows('asset_map_delete')) {
                    return abort(401);
                }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'asset_maps.id',
                'asset_maps.title',
                'asset_maps.body',
                'asset_maps.target',
                'asset_maps.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'asset_map_';
                $routeKey = 'admin.asset_maps';

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
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.asset_maps.index');
    }

    /**
     * Show the form for creating new AssetMap.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('asset_map_create')) {
            return abort(401);
        }

        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        return view('admin.asset_maps.create', compact('projects'));
    }

    /**
     * Store a newly created AssetMap in storage.
     *
     * @param  \App\Http\Requests\StoreAssetMapsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetMapsRequest $request)
    {
        if (! Gate::allows('asset_map_create')) {
            return abort(401);
        }
        $asset_map = AssetMap::create($request->all());



        return redirect()->route('admin.asset_maps.index');
    }


    /**
     * Show the form for editing AssetMap.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('asset_map_edit')) {
            return abort(401);
        }
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $asset_map = AssetMap::findOrFail($id);

        return view('admin.asset_maps.edit', compact('asset_map', 'projects'));
    }

    /**
     * Update AssetMap in storage.
     *
     * @param  \App\Http\Requests\UpdateAssetMapsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssetMapsRequest $request, $id)
    {
        if (! Gate::allows('asset_map_edit')) {
            return abort(401);
        }
        $asset_map = AssetMap::findOrFail($id);
        $asset_map->update($request->all());



        return redirect()->route('admin.asset_maps.index');
    }


    /**
     * Display AssetMap.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        if (! Gate::allows('asset_map_view')) {
//            return abort(401);
//        }
        $asset_map = AssetMap::findOrFail($id);

        return view('admin.asset_maps.show', compact('asset_map'));
    }


    /**
     * Remove AssetMap from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('asset_map_delete')) {
            return abort(401);
        }
        $asset_map = AssetMap::findOrFail($id);
        $asset_map->delete();

        return redirect()->route('admin.asset_maps.index');
    }

    /**
     * Delete all selected AssetMap at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('asset_map_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = AssetMap::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore AssetMap from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('asset_map_delete')) {
            return abort(401);
        }
        $asset_map = AssetMap::onlyTrashed()->findOrFail($id);
        $asset_map->restore();

        return redirect()->route('admin.asset_maps.index');
    }

    /**
     * Permanently delete AssetMap from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('asset_map_delete')) {
            return abort(401);
        }
        $asset_map = AssetMap::onlyTrashed()->findOrFail($id);
        $asset_map->forceDelete();

        return redirect()->route('admin.asset_maps.index');
    }

    public function diagram()
    {
//        return view('admin.asset_map');
        $asset_maps = AssetMap::all();
        return view('admin.asset_map', compact('asset_maps'));
    }
}
