@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.professional-category.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.professional-category.fields.name')</th>
                            <td field-key='name'>{{ $professional_category->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="users">
<table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.users.fields.name')</th>
                        <th>@lang('global.users.fields.surname')</th>
                        <th>@lang('global.users.fields.email')</th>
                        <th>@lang('global.users.fields.role')</th>
                        <th>@lang('global.users.fields.project')</th>
                        <th>@lang('global.users.fields.professional-category')</th>
                        <th>@lang('global.users.fields.education')</th>
                        <th>@lang('global.users.fields.institution')</th>
                        <th>@lang('global.users.fields.country')</th>
                        <th>@lang('global.users.fields.photo')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($users) > 0)
            @foreach ($users as $user)
                <tr data-entry-id="{{ $user->id }}">
                    <td field-key='name'>{{ $user->name }}</td>
                                <td field-key='surname'>{{ $user->surname }}</td>
                                <td field-key='email'>{{ $user->email }}</td>
                                <td field-key='role'>
                                    @foreach ($user->role as $singleRole)
                                        <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='project'>{{ $user->project->name ?? '' }}</td>
                                <td field-key='professional_category'>{{ $user->professional_category->name ?? '' }}</td>
                                <td field-key='education'>{{ $user->education->name ?? '' }}</td>
                                <td field-key='institution'>{{ $user->institution }}</td>
                                <td field-key='country'>{{ $user->country->shortcode ?? '' }}</td>
                                <td field-key='photo'>@if($user->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user->photo) }}"/></a>@endif</td>
                                                                <td>
                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('user_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.professional_categories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


