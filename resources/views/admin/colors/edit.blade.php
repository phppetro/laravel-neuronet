@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.color.title')</h3>
    
    {!! Form::model($color, ['method' => 'PUT', 'route' => ['admin.colors.update', $color->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('color', trans('global.color.fields.color').'', ['class' => 'control-label']) !!}
                    {!! Form::text('color', old('color'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('color'))
                        <p class="help-block">
                            {{ $errors->first('color') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('value', trans('global.color.fields.value').'', ['class' => 'control-label']) !!}
                    {!! Form::text('value', old('value'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('value'))
                        <p class="help-block">
                            {{ $errors->first('value') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

