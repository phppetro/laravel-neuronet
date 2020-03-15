<?php

namespace App\Http\Controllers\Admin;

use App\CountriesMetric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCountriesMetricsRequest;
use App\Http\Requests\Admin\UpdateCountriesMetricsRequest;
use Yajra\DataTables\DataTables;

class CountriesMetricsController extends Controller
{
    /**
     * Display a listing of CountriesMetric.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('countries_metric_access')) {
            return abort(401);
        }



        if (request()->ajax()) {
            $query = CountriesMetric::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

                if (! Gate::allows('countries_metric_delete')) {
                    return abort(401);
                }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'countries_metrics.id',
                'countries_metrics.name',
                'countries_metrics.number',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'countries_metric_';
                $routeKey = 'admin.countries_metrics';

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

        return view('admin.countries_metrics.index');
    }

    /**
     * Show the form for creating new CountriesMetric.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('countries_metric_create')) {
            return abort(401);
        }
        return view('admin.countries_metrics.create');
    }

    /**
     * Store a newly created CountriesMetric in storage.
     *
     * @param  \App\Http\Requests\StoreCountriesMetricsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountriesMetricsRequest $request)
    {
        if (! Gate::allows('countries_metric_create')) {
            return abort(401);
        }
        $countries_metric = CountriesMetric::create($request->all());



        return redirect()->route('admin.countries_metrics.index');
    }


    /**
     * Show the form for editing CountriesMetric.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('countries_metric_edit')) {
            return abort(401);
        }
        $countries_metric = CountriesMetric::findOrFail($id);

        return view('admin.countries_metrics.edit', compact('countries_metric'));
    }

    /**
     * Update CountriesMetric in storage.
     *
     * @param  \App\Http\Requests\UpdateCountriesMetricsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountriesMetricsRequest $request, $id)
    {
        if (! Gate::allows('countries_metric_edit')) {
            return abort(401);
        }
        $countries_metric = CountriesMetric::findOrFail($id);
        $countries_metric->update($request->all());



        return redirect()->route('admin.countries_metrics.index');
    }


    /**
     * Display CountriesMetric.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('countries_metric_view')) {
            return abort(401);
        }
        $countries_metric = CountriesMetric::findOrFail($id);

        return view('admin.countries_metrics.show', compact('countries_metric'));
    }


    /**
     * Remove CountriesMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('countries_metric_delete')) {
            return abort(401);
        }
        $countries_metric = CountriesMetric::findOrFail($id);
        $countries_metric->delete();

        return redirect()->route('admin.countries_metrics.index');
    }

    /**
     * Delete all selected CountriesMetric at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('countries_metric_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CountriesMetric::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore CountriesMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('countries_metric_delete')) {
            return abort(401);
        }
        $countries_metric = CountriesMetric::onlyTrashed()->findOrFail($id);
        $countries_metric->restore();

        return redirect()->route('admin.countries_metrics.index');
    }

    /**
     * Permanently delete CountriesMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('countries_metric_delete')) {
            return abort(401);
        }
        $countries_metric = CountriesMetric::onlyTrashed()->findOrFail($id);
        $countries_metric->forceDelete();

        return redirect()->route('admin.countries_metrics.index');
    }
}
