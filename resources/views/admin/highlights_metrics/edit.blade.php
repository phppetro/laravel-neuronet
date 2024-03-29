@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.highlights-metrics.title')</h3>

    {!! Form::model($highlights_metric, ['method' => 'PUT', 'route' => ['admin.highlights_metrics.update', $highlights_metric->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.highlights-metrics.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('number', trans('global.highlights-metrics.fields.number').'*', ['class' => 'control-label']) !!}
                    @if($highlights_metric->id == 1 || $highlights_metric->id == 3 || $highlights_metric->id == 4 || $highlights_metric->id == 6)
                        {!! Form::number('number', old('number'), ['class' => 'form-control', 'placeholder' => '', 'readonly' => '']) !!}
                        <p class="help-block">Read only field, the system update it automatically.</p>
                    @else
                        {!! Form::number('number', old('number'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    @endif
                    <p class="help-block"></p>
                    @if($errors->has('number'))
                        <p class="help-block">
                            {{ $errors->first('number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('order', trans('global.highlights-metrics.fields.order'), ['class' => 'control-label']) !!}
                    {!! Form::number('order', old('order'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('number'))
                        <p class="help-block">
                            {{ $errors->first('number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($highlights_metric->image)
                        <a href="{{ asset(env('UPLOAD_PATH').'/img/'.$highlights_metric->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/img/thumb/'.$highlights_metric->image) }}"></a>
                    @endif
                    {!! Form::label('image', trans('global.highlights-metrics.fields.image').'*', ['class' => 'control-label']) !!}
                    {!! Form::file('image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('image_max_size', 2) !!}
                    {!! Form::hidden('image_max_width', 4096) !!}
                    {!! Form::hidden('image_max_height', 4096) !!}
                    <p class="help-block">Max. size: 2MB, Max. width 4096px, Max. height: 4096px, Allowed file extensions : jpeg, png and gif</p>
                    @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

