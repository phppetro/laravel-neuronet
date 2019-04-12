<?php

namespace App\Http\Controllers\Admin;

use App\PartnersMetric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartnersMetricsRequest;
use App\Http\Requests\Admin\UpdatePartnersMetricsRequest;
use Yajra\DataTables\DataTables;

class PartnersMetricsController extends Controller
{
    /**
     * Display a listing of PartnersMetric.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('partners_metric_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = PartnersMetric::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('partners_metric_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'partners_metrics.id',
                'partners_metrics.name',
                'partners_metrics.number',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'partners_metric_';
                $routeKey = 'admin.partners_metrics';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.partners_metrics.index');
    }

    /**
     * Show the form for creating new PartnersMetric.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('partners_metric_create')) {
            return abort(401);
        }
        return view('admin.partners_metrics.create');
    }

    /**
     * Store a newly created PartnersMetric in storage.
     *
     * @param  \App\Http\Requests\StorePartnersMetricsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnersMetricsRequest $request)
    {
        if (! Gate::allows('partners_metric_create')) {
            return abort(401);
        }
        $partners_metric = PartnersMetric::create($request->all());



        return redirect()->route('admin.partners_metrics.index');
    }


    /**
     * Show the form for editing PartnersMetric.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('partners_metric_edit')) {
            return abort(401);
        }
        $partners_metric = PartnersMetric::findOrFail($id);

        return view('admin.partners_metrics.edit', compact('partners_metric'));
    }

    /**
     * Update PartnersMetric in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnersMetricsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartnersMetricsRequest $request, $id)
    {
        if (! Gate::allows('partners_metric_edit')) {
            return abort(401);
        }
        $partners_metric = PartnersMetric::findOrFail($id);
        $partners_metric->update($request->all());



        return redirect()->route('admin.partners_metrics.index');
    }


    /**
     * Display PartnersMetric.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('partners_metric_view')) {
            return abort(401);
        }
        $partners_metric = PartnersMetric::findOrFail($id);

        return view('admin.partners_metrics.show', compact('partners_metric'));
    }


    /**
     * Remove PartnersMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('partners_metric_delete')) {
            return abort(401);
        }
        $partners_metric = PartnersMetric::findOrFail($id);
        $partners_metric->delete();

        return redirect()->route('admin.partners_metrics.index');
    }

    /**
     * Delete all selected PartnersMetric at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('partners_metric_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PartnersMetric::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore PartnersMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('partners_metric_delete')) {
            return abort(401);
        }
        $partners_metric = PartnersMetric::onlyTrashed()->findOrFail($id);
        $partners_metric->restore();

        return redirect()->route('admin.partners_metrics.index');
    }

    /**
     * Permanently delete PartnersMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('partners_metric_delete')) {
            return abort(401);
        }
        $partners_metric = PartnersMetric::onlyTrashed()->findOrFail($id);
        $partners_metric->forceDelete();

        return redirect()->route('admin.partners_metrics.index');
    }
}
