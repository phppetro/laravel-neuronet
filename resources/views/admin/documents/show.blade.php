@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.documents.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.documents.fields.name')</th>
                            <td field-key='name'>{{ $document->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.documents.fields.file')</th>
                            <td field-key='file'>@if($document->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $document->file) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.documents.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


