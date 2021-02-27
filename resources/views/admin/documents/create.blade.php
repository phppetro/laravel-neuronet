@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.documents.title2')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.documents.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.documents.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('source', trans('global.documents.fields.source').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('source', old('source'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('source'))
                        <p class="help-block">
                            {{ $errors->first('source') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('publication_date', trans('global.documents.fields.publication-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('publication_date', old('publication_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('publication_date'))
                        <p class="help-block">
                            {{ $errors->first('publication_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('keywords', trans('global.documents.fields.keywords').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('keywords', old('keywords'), ['class' => 'form-control ', 'placeholder' => 'Separate keywords with commas']) !!}
                    <p class="help-block">Separate keywords with commas</p>
                    @if($errors->has('keywords'))
                        <p class="help-block">
                            {{ $errors->first('keywords') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('file', trans('global.documents.fields.file').'*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('file', old('file')) !!}
                    {!! Form::file('file', ['class' => 'form-control', 'required' => '']) !!}
                    {!! Form::hidden('file_max_size', 2) !!}
                    <p class="help-block">Maximum size: 2MB, Allowed file extensions : pdf, jpeg, png, gif, doc, docx</p>
                    @if($errors->has('file'))
                        <p class="help-block">
                            {{ $errors->first('file') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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
