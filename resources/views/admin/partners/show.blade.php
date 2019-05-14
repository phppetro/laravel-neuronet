@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.partners.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.partners.fields.name')</th>
                            <td field-key='name'>{{ $partner->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partners.fields.projects')</th>
                            <td field-key='projects'>
                                @foreach ($partner->projects as $singleProjects)
                                    <span class="label label-info label-many">{{ $singleProjects->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.partners.fields.type-of-institution')</th>
                            <td field-key='type_of_institution'>{{ $partner->type_of_institution->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partners.fields.country')</th>
                            <td field-key='country'>{{ $partner->country->title ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.partners.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


