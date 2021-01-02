@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.highlights-metrics.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.highlights-metrics.fields.name')</th>
                            <td field-key='name'>{{ $highlights_metric->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.highlights-metrics.fields.number')</th>
                            <td field-key='number'>{{ $highlights_metric->number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.highlights-metrics.fields.order')</th>
                            <td field-key='number'>{{ $highlights_metric->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.highlights-metrics.fields.image')</th>
                            <td field-key='image'>@if($highlights_metric->image)<a href="{{ asset(env('UPLOAD_PATH').'/img/' . $highlights_metric->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/img/thumb/' . $highlights_metric->image) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.highlights_metrics.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


