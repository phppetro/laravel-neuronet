@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.decision-tool.title')</h3>

    {!! Form::model($decision_tool, ['method' => 'PUT', 'route' => ['admin.decision_tools.update', $decision_tool->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.decision-tool.fields.title').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('body', trans('global.decision-tool.fields.body').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('body', old('body'), ['class' => 'form-control editor', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('body'))
                        <p class="help-block">
                            {{ $errors->first('body') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('target', trans('global.decision-tool.fields.target').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('target', old('target'), ['class' => 'form-control', 'placeholder' => 'BE CAREFUL: Key used by the system to open the modal window. an error could break the system.', 'required' => '']) !!}
                    <p class="help-block">BE CAREFUL: Key used by the system to open the modal window. an error could break the system.</p>
                    @if($errors->has('target'))
                        <p class="help-block">
                            {{ $errors->first('target') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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