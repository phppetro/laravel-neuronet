@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.calendar.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.calendar.fields.date')</th>
                            <td field-key='date'>{{ $calendar->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.calendar.fields.title')</th>
                            <td field-key='title'>{{ $calendar->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.calendar.fields.project')</th>
                            <td field-key='project'>{{ $calendar->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.calendar.fields.location')</th>
                            <td field-key='location'>{{ $calendar->location }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.calendars.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop
