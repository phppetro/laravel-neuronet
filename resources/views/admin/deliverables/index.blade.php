@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">
      @lang('global.deliverables.title')
      @if($project_name )
         associated with the project "{{ $project_name }}"
      @endif
    </h3>
    @can('deliverable_create')
    <p>
        <a href="{{ route('admin.deliverables.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'Deliverable'])

    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.deliverables.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.deliverables.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>


    <div class="panel panel-default">
        <div class="panel-heading">
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-flat">Filter by project</button>
            <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
              @foreach($projects as $project)
                @if($project->name == $project_name)
                  <li><a href="/admin/deliverables/project/{{ $project->id }}"><b><u>{{ $project->name }}</u></b></a></li>
                @else
                  <li><a href="/admin/deliverables/project/{{ $project->id }}">{{ $project->name }}</a></li>
                @endif
              @endforeach
                <li class="divider"></li>
                @if($project_name)
                  <li><a href="/admin/deliverables">Remove filter</a></li>
                @else
                  <li><a href="/admin/deliverables">No filter applied</a></li>
                @endif
            </ul>
          </div>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('deliverable_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('deliverable_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('deliverable_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.deliverables.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {

            var project_id='';
            var currentURL = $(location).attr('href');
            if (currentURL.indexOf("project") >= 0) {
              var array = currentURL.split('/');
              project_id = array[6];
            }

            window.dtDefaultOptions.ajax = '{!! route('admin.deliverables.index') !!}?show_deleted={{ request('show_deleted') }}&project_id=';
            window.dtDefaultOptions.ajax+=project_id;
            window.dtDefaultOptions.columns = [@can('deliverable_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'title', name: 'title'},
                {data: 'project.name', name: 'project.name'},
                {data: 'submission_date', name: 'submission_date'},
                {data: 'link', name: 'link'},
                {data: 'keywords', name: 'keywords'},

                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection
