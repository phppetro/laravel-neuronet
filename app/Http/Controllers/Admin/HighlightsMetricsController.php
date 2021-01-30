<?php

namespace App\Http\Controllers\Admin;

use App\HighlightsMetric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHighlightsMetricsRequest;
use App\Http\Requests\Admin\UpdateHighlightsMetricsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class HighlightsMetricsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of HighlightsMetric.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('highlights_metric_access')) {
            return abort(401);
        }



        if (request()->ajax()) {
            $query = HighlightsMetric::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

        if (! Gate::allows('highlights_metric_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'highlights_metrics.id',
                'highlights_metrics.image',
                'highlights_metrics.name',
                'highlights_metrics.number',
                'highlights_metrics.order',
            ])->orderBy('order');
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'highlights_metric_';
                $routeKey = 'admin.highlights_metrics';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });
            $table->editColumn('order', function ($row) {
                return $row->order ? $row->order : '';
            });
            $table->editColumn('image', function ($row) {
                if($row->image) { return '<a href="'. asset(env('UPLOAD_PATH').'/img/' . $row->image) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/img/thumb/' . $row->image) .'"/>'; };
            });

            $table->rawColumns(['actions','massDelete','image']);

            return $table->make(true);
        }

        return view('admin.highlights_metrics.index');
    }

    /**
     * Show the form for creating new HighlightsMetric.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('highlights_metric_create')) {
            return abort(401);
        }
        return view('admin.highlights_metrics.create');
    }

    /**
     * Store a newly created HighlightsMetric in storage.
     *
     * @param  \App\Http\Requests\StoreHighlightsMetricsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHighlightsMetricsRequest $request)
    {
        if (! Gate::allows('highlights_metric_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $highlights_metric = HighlightsMetric::create($request->all());



        return redirect()->route('admin.highlights_metrics.index');
    }


    /**
     * Show the form for editing HighlightsMetric.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('highlights_metric_edit')) {
            return abort(401);
        }
        $highlights_metric = HighlightsMetric::findOrFail($id);

        return view('admin.highlights_metrics.edit', compact('highlights_metric'));
    }

    /**
     * Update HighlightsMetric in storage.
     *
     * @param  \App\Http\Requests\UpdateHighlightsMetricsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHighlightsMetricsRequest $request, $id)
    {
        if (! Gate::allows('highlights_metric_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $highlights_metric = HighlightsMetric::findOrFail($id);
        $highlights_metric->update($request->all());



        return redirect()->route('admin.highlights_metrics.index');
    }


    /**
     * Display HighlightsMetric.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('highlights_metric_view')) {
            return abort(401);
        }
        $highlights_metric = HighlightsMetric::findOrFail($id);

        return view('admin.highlights_metrics.show', compact('highlights_metric'));
    }


    /**
     * Remove HighlightsMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('highlights_metric_delete')) {
            return abort(401);
        }
        $highlights_metric = HighlightsMetric::findOrFail($id);
        $highlights_metric->delete();

        return redirect()->route('admin.highlights_metrics.index');
    }

    /**
     * Delete all selected HighlightsMetric at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('highlights_metric_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = HighlightsMetric::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore HighlightsMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('highlights_metric_delete')) {
            return abort(401);
        }
        $highlights_metric = HighlightsMetric::onlyTrashed()->findOrFail($id);
        $highlights_metric->restore();

        return redirect()->route('admin.highlights_metrics.index');
    }

    /**
     * Permanently delete HighlightsMetric from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('highlights_metric_delete')) {
            return abort(401);
        }
        $highlights_metric = HighlightsMetric::onlyTrashed()->findOrFail($id);
        $highlights_metric->forceDelete();

        return redirect()->route('admin.highlights_metrics.index');
    }
}
