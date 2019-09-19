@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.activity.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.activity.fields.user')</th>
                            <td field-key='user'>{{ $activity->user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.activity.fields.date')</th>
                            <td field-key='date'>{{ $activity->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.activity.fields.message')</th>
                            <td field-key='message'>{!! $activity->message !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.activity.fields.project')</th>
                            <td field-key='project'>{{ $activity->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.activities.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
