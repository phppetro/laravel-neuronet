@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverables.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.deliverables.fields.deliverable-number')</th>
                            <td field-key='deliverable_number'>{{ $deliverable->deliverable_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.title')</th>
                            <td field-key='title'>{{ $deliverable->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.project')</th>
                            <td field-key='project'>{{ $deliverable->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.submission-date')</th>
                            <td field-key='submission_date'>{{ $deliverable->submission_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.link')</th>
                            <td field-key='link'>{{ $deliverable->link }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.keywords')</th>
                            <td field-key='keywords'>{!! $deliverable->keywords !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.deliverables.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
