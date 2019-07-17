@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.surname')</th>
                            <td field-key='surname'>{{ $user->surname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.project')</th>
                            <td field-key='project'>{{ $user->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.professional-category')</th>
                            <td field-key='professional_category'>{{ $user->professional_category->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.education')</th>
                            <td field-key='education'>{{ $user->education->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.institution')</th>
                            <td field-key='institution'>{{ $user->institution }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.country')</th>
                            <td field-key='country'>{{ $user->country->title ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.photo')</th>
                            <td field-key='photo'>@if($user->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user->photo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $user->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.account-reason')</th>
                            <td field-key='account_reason'>{!! $user->account_reason !!}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#user_actions" aria-controls="user_actions" role="tab" data-toggle="tab">User actions</a></li>
<li role="presentation" class=""><a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">Activity</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="user_actions">
<table class="table table-bordered table-striped {{ count($user_actions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.user-actions.created_at')</th>
                        <th>@lang('global.user-actions.fields.user')</th>
                        <th>@lang('global.user-actions.fields.action')</th>
                        <th>@lang('global.user-actions.fields.action-model')</th>
                        <th>@lang('global.user-actions.fields.action-id')</th>
                        
        </tr>
    </thead>

    <tbody>
        @if (count($user_actions) > 0)
            @foreach ($user_actions as $user_action)
                <tr data-entry-id="{{ $user_action->id }}">
                    <td>{{ $user_action->created_at ?? '' }}</td>
                                <td field-key='user'>{{ $user_action->user->name ?? '' }}</td>
                                <td field-key='action'>{{ $user_action->action }}</td>
                                <td field-key='action_model'>{{ $user_action->action_model }}</td>
                                <td field-key='action_id'>{{ $user_action->action_id }}</td>
                                
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
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
                        <th>@lang('global.activity.fields.body')</th>
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
                                <td field-key='body'>{{ $activity->body }}</td>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


