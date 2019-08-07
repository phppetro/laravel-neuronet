@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">
      @lang('global.tools.title')
      @if($project_name )
         associated with the project "{{ $project_name }}"
      @endif
    </h3>
    @can('tool_create')
    <p>
        <a href="{{ route('admin.tools.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'Tool'])

    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.tools.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.tools.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>


    <div class="panel panel-default">
        <div class="panel-heading">
          Select a project:
            @if($project_name)
              <a class="btn btn-xs btn-purple" href="/admin/tools/">See all work packages</a>
            @else
              <a class="btn btn-xs btn-pink" href="/admin/tools/">See all work packages</a>
            @endif
          @foreach($projects as $project)
            @if($project->name == $project_name)
              <a class="btn btn-xs btn-pink" href="/admin/tools/project/{{ $project->id }}">{{ $project->name }}</a>
            @else
            <a class="btn btn-xs btn-purple" href="/admin/tools/project/{{ $project->id }}">{{ $project->name }}</a>
            @endif
          @endforeach
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('tool_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('tool_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('tool_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.tools.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {

            var project_id='';
            var currentURL = $(location).attr('href');
            if (currentURL.indexOf("project") >= 0) {
              var array = currentURL.split('/');
              project_id = array[6];
            }

            window.dtDefaultOptions.ajax = '{!! route('admin.tools.index') !!}?show_deleted={{ request('show_deleted') }}&project_id=';
            window.dtDefaultOptions.ajax+=project_id;
            window.dtDefaultOptions.columns = [@can('tool_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'name', name: 'name'},
                {data: 'project.name', name: 'project.name'},
                {data: 'publication_date', name: 'publication_date'},
                {data: 'type_of_data_available', name: 'type_of_data_available'},
                {data: 'description', name: 'description'},
                {data: 'keywords', name: 'keywords'},
                {data: 'link', name: 'link'},

                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection
