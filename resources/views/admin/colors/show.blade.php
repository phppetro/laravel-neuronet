@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.color.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.color.fields.color')</th>
                            <td field-key='color'>{{ $color->color }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.color.fields.value')</th>
                            <td field-key='value'>{{ $color->value }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#calendar" aria-controls="calendar" role="tab" data-toggle="tab">Events</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="calendar">
<table class="table table-bordered table-striped {{ count($calendars) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.calendar.fields.title')</th>
                        <th>@lang('global.calendar.fields.location')</th>
                        <th>@lang('global.calendar.fields.start-date')</th>
                        <th>@lang('global.calendar.fields.end-date')</th>
                        <th>@lang('global.calendar.fields.color')</th>
                        <th>@lang('global.calendar.fields.projects')</th>
                        <th>@lang('global.calendar.fields.link')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($calendars) > 0)
            @foreach ($calendars as $calendar)
                <tr data-entry-id="{{ $calendar->id }}">
                    <td field-key='title'>{{ $calendar->title }}</td>
                                <td field-key='location'>{{ $calendar->location }}</td>
                                <td field-key='start_date'>{{ $calendar->start_date }}</td>
                                <td field-key='end_date'>{{ $calendar->end_date }}</td>
                                <td field-key='color'>{{ $calendar->color->color ?? '' }}</td>
                                <td field-key='projects'>
                                    @foreach ($calendar->projects as $singleProjects)
                                        <span class="label label-info label-many">{{ $singleProjects->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='link'>{{ $calendar->link }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.calendars.restore', $calendar->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.calendars.perma_del', $calendar->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('calendar_view')
                                    <a href="{{ route('admin.calendars.show',[$calendar->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('calendar_edit')
                                    <a href="{{ route('admin.calendars.edit',[$calendar->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('calendar_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.calendars.destroy', $calendar->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.colors.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


