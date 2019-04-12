<?php

namespace App\Http\Controllers\Api\V1;

use App\PartnersMetric;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartnersMetricsRequest;
use App\Http\Requests\Admin\UpdatePartnersMetricsRequest;
use Yajra\DataTables\DataTables;

class PartnersMetricsController extends Controller
{
    public function index()
    {
        return PartnersMetric::all();
    }

    public function show($id)
    {
        return PartnersMetric::findOrFail($id);
    }

    public function update(UpdatePartnersMetricsRequest $request, $id)
    {
        $partners_metric = PartnersMetric::findOrFail($id);
        $partners_metric->update($request->all());
        

        return $partners_metric;
    }

    public function store(StorePartnersMetricsRequest $request)
    {
        $partners_metric = PartnersMetric::create($request->all());
        

        return $partners_metric;
    }

    public function destroy($id)
    {
        $partners_metric = PartnersMetric::findOrFail($id);
        $partners_metric->delete();
        return '';
    }
}
