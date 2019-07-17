@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.tools.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.tools.fields.name')</th>
                            <td field-key='name'>{{ $tool->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tools.fields.project')</th>
                            <td field-key='project'>{{ $tool->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tools.fields.description')</th>
                            <td field-key='description'>{{ $tool->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tools.fields.keywords')</th>
                            <td field-key='keywords'>{{ $tool->keywords }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tools.fields.link')</th>
                            <td field-key='link'>{{ $tool->link }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.tools.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


