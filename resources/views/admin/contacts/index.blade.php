@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">
      @lang('global.contacts.title')
      @if($category_name )
       in the category "{{ $category_name }}"
      @endif
    @can('contact_create')

        <a href="{{ route('admin.contacts.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        @can('contact_csv_import')
          <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
          @include('csvImport.modal', ['model' => 'Contact'])
        @endcan


    @endcan
    </h3>
    @can('contact_perma_del')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.contacts.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.contacts.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    @endcan

    <div class="panel panel-default">



        <div class="panel-heading">
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-flat">Filter by contact category</button>
            <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
              @foreach($categories as $category)
                @if($category->name == $category_name)
                  <li><a href="/admin/contacts/category/{{ $category->id }}"><b><u>{{ $category->name }}</u></b></a></li>
                @else
                  <li><a href="/admin/contacts/category/{{ $category->id }}">{{ $category->name }}</a></li>
                @endif
              @endforeach
                <li class="divider"></li>
                @if($category_name)
                  <li><a href="/admin/contacts">Remove filter</a></li>
                @else
                  <li><a href="/admin/contacts">No filter applied</a></li>
                @endif
            </ul>
          </div>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('contact_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('contact_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.contacts.fields.first-name')</th>
                        <th>@lang('global.contacts.fields.last-name')</th>
                        <th>@lang('global.contacts.fields.email')</th>
                        <th>@lang('global.contacts.fields.position')</th>
                        <th>@lang('global.contacts.fields.institution')</th>
                        <th>@lang('global.contacts.fields.category')</th>
                        <th>@lang('global.contacts.fields.projects-involved')</th>
                        <th>@lang('global.contacts.fields.expertise')</th>
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
        @can('contact_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.contacts.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {

          var category_id='';
          var currentURL = $(location).attr('href');
          if (currentURL.indexOf("category") >= 0) {
            var array = currentURL.split('/');
            category_id = array[6];
          }

            window.dtDefaultOptions.ajax = '{!! route('admin.contacts.index') !!}?show_deleted={{ request('show_deleted') }}&category_id=';
            window.dtDefaultOptions.ajax+=category_id;
            window.dtDefaultOptions.columns = [@can('contact_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'position', name: 'position'},
                {data: 'institution', name: 'institution'},
                {data: 'category.name', name: 'category.name'},
                {data: 'projects_involved', name: 'projects_involved'},
                {data: 'expertise', name: 'expertise'},
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection
