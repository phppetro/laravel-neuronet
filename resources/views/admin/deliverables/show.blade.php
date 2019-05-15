@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverables.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.deliverables.fields.label')</th>
                            <td field-key='label'>{{ $deliverable->label }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.title')</th>
                            <td field-key='title'>{{ $deliverable->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.wp')</th>
                            <td field-key='wp'>{{ $deliverable->wp->description ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.project')</th>
                            <td field-key='project'>{{ $deliverable->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.link')</th>
                            <td field-key='link'>{{ $deliverable->link }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.deliverables.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


