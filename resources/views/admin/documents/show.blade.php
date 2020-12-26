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
                            <th>@lang('global.documents.fields.title')</th>
                            <td field-key='title'>{{ $document->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.documents.fields.source')</th>
                            <td field-key='source'>{{ $document->source }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.documents.fields.publication-date')</th>
                            <td field-key='publication_date'>{{ $document->publication_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.documents.fields.keywords')</th>
                            <td field-key='keywords'>{!! $document->keywords !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.documents.fields.file')</th>
                            <td field-key='file'>@if($document->file)<a href="{{ asset(env('UPLOAD_PATH').'/img/' . $document->file) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.documents.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });

            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });

        });
    </script>

@stop
