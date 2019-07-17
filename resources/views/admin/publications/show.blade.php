@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.publications.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.publications.fields.title')</th>
                            <td field-key='title'>{{ $publication->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.publications.fields.first-author-last-name')</th>
                            <td field-key='first_author_last_name'>{{ $publication->first_author_last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.publications.fields.year')</th>
                            <td field-key='year'>{{ $publication->year }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.publications.fields.project')</th>
                            <td field-key='project'>{{ $publication->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.publications.fields.link')</th>
                            <td field-key='link'>{{ $publication->link }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.publications.fields.keywords')</th>
                            <td field-key='keywords'>{{ $publication->keywords }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.publications.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


