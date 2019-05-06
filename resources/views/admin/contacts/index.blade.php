@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.contacts.title')
      @can('contact_create')
          <a href="{{ route('admin.contacts.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
      @endcan
      @can('contact_csv_import')
          <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
          @include('csvImport.modal', ['model' => 'Contact'])
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
            @lang('global.app_list')
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
                        <th>@lang('global.contacts.fields.category')</th>
                        <th>@lang('global.contacts.fields.phone1')</th>
                        <th>@lang('global.contacts.fields.phone2')</th>
                        <th>@lang('global.contacts.fields.email')</th>
                        <th>@lang('global.contacts.fields.skype')</th>
                        <th>@lang('global.contacts.fields.address')</th>
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
            window.dtDefaultOptions.ajax = '{!! route('admin.contacts.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('contact_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'category.name', name: 'category.name'},
                {data: 'phone1', name: 'phone1'},
                {data: 'phone2', name: 'phone2'},
                {data: 'email', name: 'email'},
                {data: 'skype', name: 'skype'},
                {data: 'address', name: 'address'},

                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection
