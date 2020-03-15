@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.countries-metrics.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.countries-metrics.fields.name')</th>
                            <td field-key='name'>{{ $countries_metric->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.countries-metrics.fields.number')</th>
                            <td field-key='number'>{{ $countries_metric->number }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.countries_metrics.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


