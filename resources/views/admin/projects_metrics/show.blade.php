@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.projects-metrics.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.projects-metrics.fields.name')</th>
                            <td field-key='name'>{{ $projects_metric->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects-metrics.fields.funding')</th>
                            <td field-key='funding'>{{ $projects_metric->funding }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.projects_metrics.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


