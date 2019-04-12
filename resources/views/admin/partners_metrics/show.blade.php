@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.partners-metrics.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.partners-metrics.fields.name')</th>
                            <td field-key='name'>{{ $partners_metric->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partners-metrics.fields.number')</th>
                            <td field-key='number'>{{ $partners_metric->number }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.partners_metrics.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


