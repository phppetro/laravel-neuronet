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
                            <th>@lang('global.calendar.fields.title')</th>
                            <td field-key='title'>{{ $calendar->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.calendar.fields.location')</th>
                            <td field-key='location'>{{ $calendar->location }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.calendar.fields.start-date')</th>
                            <td field-key='start_date'>{{ $calendar->start_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.calendar.fields.end-date')</th>
                            <td field-key='end_date'>{{ $calendar->end_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.calendar.fields.color')</th>
                            <td field-key='color'>{{ $calendar->color->color ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.calendar.fields.projects')</th>
                            <td field-key='projects'>
                                @foreach ($calendar->projects as $singleProjects)
                                    <span class="label label-info label-many">{{ $singleProjects->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.calendar.fields.link')</th>
                            <td field-key='link'><a target="_blank" href="{{ $calendar->link }}">{{ $calendar->link }}</a></td>
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

            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });

        });
    </script>

@stop
