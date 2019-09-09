@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.work-packages.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.work-packages.fields.wp-number')</th>
                            <td field-key='wp_number'>{{ $work_package->wp_number->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.work-packages.fields.description')</th>
                            <td field-key='description'>{{ $work_package->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.work-packages.fields.project')</th>
                            <td field-key='project'>{{ $work_package->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.work_packages.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


