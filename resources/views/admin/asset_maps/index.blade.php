@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">
        @lang('global.asset-map.title')
    @can('asset_map_create')
        <a href="{{ route('admin.asset_maps.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
            @can('asset_map_csv_import')
            @endcan
    @endcan
    </h3>
    @can('asset_map_perma_del')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.asset_maps.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.asset_maps.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    @endcan

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
                            <li><a href="/admin/asset_maps/project/{{ $project->id }}"><b><u>{{ $project->name }}</u></b></a></li>
                        @else
                            <li><a href="/admin/asset_maps/project/{{ $project->id }}">{{ $project->name }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            @if($project_name)
                <a class="btn btn-info" href="/admin/asset_maps">Applied filter: "{{ $project_name }}" <u>Click here to remove it</u></a>
            @endif
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('asset_map_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('asset_map_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.asset-map.fields.title')</th>
                        <th>@lang('global.asset-map.fields.body')</th>
                        <th>@lang('global.asset-map.fields.target')</th>
                        <th>@lang('global.asset-map.fields.project')</th>
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
        @can('asset_map_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.asset_maps.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            var project_id='';
            var currentURL = $(location).attr('href');
            if (currentURL.indexOf("project") >= 0) {
                var array = currentURL.split('/');
                project_id = array[6];
            }

            window.dtDefaultOptions.ajax = '{!! route('admin.asset_maps.index') !!}?show_deleted={{ request('show_deleted') }}&project_id=';
            window.dtDefaultOptions.ajax+=project_id;
            window.dtDefaultOptions.columns = [@can('asset_map_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'title', name: 'title'},
                {data: 'body', name: 'body'},
                {data: 'target', name: 'target'},
                {data: 'project.name', name: 'project.name'},

                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();

            function removeHtmlTags(eq) {
                setTimeout(() => {
                    $('tbody tr').each(function (index, value) {
                        $('tbody tr:eq(' + index + ') td:eq(' + eq + ')').html($('tbody tr:eq(' + index + ') td:eq(' + eq + ')').text());
                    });
                }, 1500);
            }

            @auth
                removeHtmlTags(2);

            @endauth
            @guest
                removeHtmlTags(1);
            @endguest
        });
    </script>
@endsection
