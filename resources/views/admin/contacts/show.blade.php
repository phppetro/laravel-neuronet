@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.contacts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.contacts.fields.first-name')</th>
                            <td field-key='first_name'>{{ $contact->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.last-name')</th>
                            <td field-key='last_name'>{{ $contact->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.email')</th>
                            <td field-key='email'>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.position')</th>
                            <td field-key='position'>{{ $contact->position }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.institution')</th>
                            <td field-key='institution'>{{ $contact->institution }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.category')</th>
                            <td field-key='category'>{{ $contact->category->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.projects-involved')</th>
                            <td field-key='projects_involved'>{{ $contact->projects_involved }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.expertise')</th>
                            <td field-key='expertise'>{!! $contact->expertise !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.contacts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


