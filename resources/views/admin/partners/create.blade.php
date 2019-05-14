@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.partners.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.partners.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.partners.fields.name').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('projects', trans('global.partners.fields.projects').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-projects">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-projects">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('projects[]', $projects, old('projects'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-projects' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('projects'))
                        <p class="help-block">
                            {{ $errors->first('projects') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('type_of_institution_id', trans('global.partners.fields.type-of-institution').'', ['class' => 'control-label']) !!}
                    {!! Form::select('type_of_institution_id', $type_of_institutions, old('type_of_institution_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('type_of_institution_id'))
                        <p class="help-block">
                            {{ $errors->first('type_of_institution_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('country_id', trans('global.partners.fields.country').'', ['class' => 'control-label']) !!}
                    {!! Form::select('country_id', $countries, old('country_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('country_id'))
                        <p class="help-block">
                            {{ $errors->first('country_id') }}
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

    <script>
        $("#selectbtn-projects").click(function(){
            $("#selectall-projects > option").prop("selected","selected");
            $("#selectall-projects").trigger("change");
        });
        $("#deselectbtn-projects").click(function(){
            $("#selectall-projects > option").prop("selected","");
            $("#selectall-projects").trigger("change");
        });
    </script>
@stop