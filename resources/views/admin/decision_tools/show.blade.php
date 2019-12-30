@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.decision-tool.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.decision-tool.fields.title')</th>
                            <td field-key='title'>{{ $decision_tool->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.decision-tool.fields.body')</th>
                            <td field-key='body'>{!! $decision_tool->body !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.decision-tool.fields.target')</th>
                            <td field-key='target'>{{ $decision_tool->target }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.decision_tools.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
            CKEDITOR.replace($(this).attr('id'),{
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop
