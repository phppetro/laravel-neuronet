@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.projects.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.projects.fields.name')</th>
                            <td field-key='name'>{{ $project->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.description')</th>
                            <td field-key='description'>{!! $project->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.website')</th>
                            <td field-key='website'>{{ $project->website }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.start-date')</th>
                            <td field-key='start_date'>{{ $project->start_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.end-date')</th>
                            <td field-key='end_date'>{{ $project->end_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.logo')</th>
                            <td field-key='logo'>@if($project->logo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $project->logo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $project->logo) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">

<li role="presentation" class="active"><a href="#partners" aria-controls="partners" role="tab" data-toggle="tab">Partners</a></li>
<li role="presentation" class=""><a href="#tools" aria-controls="tools" role="tab" data-toggle="tab">Tools</a></li>
<li role="presentation" class=""><a href="#work_packages" aria-controls="work_packages" role="tab" data-toggle="tab">Work packages</a></li>
<li role="presentation" class=""><a href="#deliverables" aria-controls="deliverables" role="tab" data-toggle="tab">Deliverables</a></li>
<li role="presentation" class=""><a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">Activity</a></li>
<li role="presentation" class=""><a href="#publications" aria-controls="publications" role="tab" data-toggle="tab">Publications</a></li>
<li role="presentation" class=""><a href="#calendar" aria-controls="calendar" role="tab" data-toggle="tab">Events</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

<div role="tabpanel" class="tab-pane active" id="partners">
<table class="table table-bordered table-striped {{ count($partners) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.partners.fields.name')</th>
                        <th>@lang('global.partners.fields.projects')</th>
                        <th>@lang('global.partners.fields.type-of-institution')</th>
                        <th>@lang('global.partners.fields.country')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($partners) > 0)
            @foreach ($partners as $partner)
                <tr data-entry-id="{{ $partner->id }}">
                    <td field-key='name'>{{ $partner->name }}</td>
                                <td field-key='projects'>
                                    @foreach ($partner->projects as $singleProjects)
                                        <span class="label label-info label-many">{{ $singleProjects->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='type_of_institution'>{{ $partner->type_of_institution->name ?? '' }}</td>
                                <td field-key='country'>{{ $partner->country->title ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.partners.restore', $partner->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.partners.perma_del', $partner->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('partner_view')
                                    <a href="{{ route('admin.partners.show',[$partner->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('partner_edit')
                                    <a href="{{ route('admin.partners.edit',[$partner->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('partner_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.partners.destroy', $partner->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="tools">
<table class="table table-bordered table-striped {{ count($tools) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.tools.fields.name')</th>
                        <th>@lang('global.tools.fields.project')</th>
                        <th>@lang('global.tools.fields.publication-date')</th>
                        <th>@lang('global.tools.fields.type-of-data-available')</th>
                        <th>@lang('global.tools.fields.description')</th>
                        <th>@lang('global.tools.fields.keywords')</th>
                        <th>@lang('global.tools.fields.link')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($tools) > 0)
            @foreach ($tools as $tool)
                <tr data-entry-id="{{ $tool->id }}">
                    <td field-key='name'>{{ $tool->name }}</td>
                                <td field-key='project'>{{ $tool->project->name ?? '' }}</td>
                                <td field-key='publication_date'>{{ $tool->publication_date }}</td>
                                <td field-key='type_of_data_available'>{{ $tool->type_of_data_available }}</td>
                                <td field-key='description'>{!! $tool->description !!}</td>
                                <td field-key='keywords'>{{ $tool->keywords }}</td>
                                <td field-key='link'>{{ $tool->link }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tools.restore', $tool->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tools.perma_del', $tool->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('tool_view')
                                    <a href="{{ route('admin.tools.show',[$tool->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('tool_edit')
                                    <a href="{{ route('admin.tools.edit',[$tool->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('tool_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tools.destroy', $tool->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="work_packages">
<table class="table table-bordered table-striped {{ count($work_packages) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.work-packages.fields.wp-number')</th>
                        <th>@lang('global.work-packages.fields.description')</th>
                        <th>@lang('global.work-packages.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($work_packages) > 0)
            @foreach ($work_packages as $work_package)
                <tr data-entry-id="{{ $work_package->id }}">
                    <td field-key='wp_number'>{{ $work_package->wp_number->name ?? '' }}</td>
                                <td field-key='description'>{{ $work_package->description }}</td>
                                <td field-key='project'>{{ $work_package->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.work_packages.restore', $work_package->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.work_packages.perma_del', $work_package->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('work_package_view')
                                    <a href="{{ route('admin.work_packages.show',[$work_package->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('work_package_edit')
                                    <a href="{{ route('admin.work_packages.edit',[$work_package->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('work_package_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.work_packages.destroy', $work_package->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="deliverables">
<table class="table table-bordered table-striped {{ count($deliverables) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deliverables.fields.deliverable-number')</th>
                        <th>@lang('global.deliverables.fields.title')</th>
                        <th>@lang('global.deliverables.fields.project')</th>
                        <th>@lang('global.deliverables.fields.submission-date')</th>
                        <th>@lang('global.deliverables.fields.link')</th>
                        <th>@lang('global.deliverables.fields.keywords')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deliverables) > 0)
            @foreach ($deliverables as $deliverable)
                <tr data-entry-id="{{ $deliverable->id }}">
                    <td field-key='deliverable_number'>{{ $deliverable->deliverable_number }}</td>
                                <td field-key='title'>{{ $deliverable->title }}</td>
                                <td field-key='project'>{{ $deliverable->project->name ?? '' }}</td>
                                <td field-key='submission_date'>{{ $deliverable->submission_date }}</td>
                                <td field-key='link'>{{ $deliverable->link }}</td>
                                <td field-key='keywords'>{!! $deliverable->keywords !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverables.restore', $deliverable->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverables.perma_del', $deliverable->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deliverable_view')
                                    <a href="{{ route('admin.deliverables.show',[$deliverable->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deliverable_edit')
                                    <a href="{{ route('admin.deliverables.edit',[$deliverable->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deliverable_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverables.destroy', $deliverable->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="activity">
<table class="table table-bordered table-striped {{ count($activities) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.activity.fields.user')</th>
                        <th>@lang('global.activity.fields.date')</th>
                        <th>@lang('global.activity.fields.message')</th>
                        <th>@lang('global.activity.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($activities) > 0)
            @foreach ($activities as $activity)
                <tr data-entry-id="{{ $activity->id }}">
                    <td field-key='user'>{{ $activity->user->name ?? '' }}</td>
                                <td field-key='date'>{{ $activity->date }}</td>
                                <td field-key='message'>{!! $activity->message !!}</td>
                                <td field-key='project'>{{ $activity->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.activities.restore', $activity->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.activities.perma_del', $activity->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('activity_view')
                                    <a href="{{ route('admin.activities.show',[$activity->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('activity_edit')
                                    <a href="{{ route('admin.activities.edit',[$activity->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('activity_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.activities.destroy', $activity->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="publications">
<table class="table table-bordered table-striped {{ count($publications) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.publications.fields.title')</th>
                        <th>@lang('global.publications.fields.first-author-last-name')</th>
                        <th>@lang('global.publications.fields.year')</th>
                        <th>@lang('global.publications.fields.project')</th>
                        <th>@lang('global.publications.fields.link')</th>
                        <th>@lang('global.publications.fields.keywords')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($publications) > 0)
            @foreach ($publications as $publication)
                <tr data-entry-id="{{ $publication->id }}">
                    <td field-key='title'>{{ $publication->title }}</td>
                                <td field-key='first_author_last_name'>{{ $publication->first_author_last_name }}</td>
                                <td field-key='year'>{{ $publication->year }}</td>
                                <td field-key='project'>{{ $publication->project->name ?? '' }}</td>
                                <td field-key='link'>{{ $publication->link }}</td>
                                <td field-key='keywords'>{!! $publication->keywords !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.publications.restore', $publication->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.publications.perma_del', $publication->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('publication_view')
                                    <a href="{{ route('admin.publications.show',[$publication->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('publication_edit')
                                    <a href="{{ route('admin.publications.edit',[$publication->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('publication_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.publications.destroy', $publication->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="calendar">
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

            <a href="{{ route('admin.projects.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
