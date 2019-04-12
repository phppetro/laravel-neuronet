<?php

namespace App\Http\Controllers\Api\V1;

use App\ProjectsMetric;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectsMetricsRequest;
use App\Http\Requests\Admin\UpdateProjectsMetricsRequest;
use Yajra\DataTables\DataTables;

class ProjectsMetricsController extends Controller
{
    public function index()
    {
        return ProjectsMetric::all();
    }

    public function show($id)
    {
        return ProjectsMetric::findOrFail($id);
    }

    public function update(UpdateProjectsMetricsRequest $request, $id)
    {
        $projects_metric = ProjectsMetric::findOrFail($id);
        $projects_metric->update($request->all());
        

        return $projects_metric;
    }

    public function store(StoreProjectsMetricsRequest $request)
    {
        $projects_metric = ProjectsMetric::create($request->all());
        

        return $projects_metric;
    }

    public function destroy($id)
    {
        $projects_metric = ProjectsMetric::findOrFail($id);
        $projects_metric->delete();
        return '';
    }
}
