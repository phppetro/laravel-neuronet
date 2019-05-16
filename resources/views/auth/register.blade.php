@extends('layouts.front')

@section('content')
<header class="masthead-auth">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Surname</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="institution" class="col-md-4 col-form-label text-md-right">Institution</label>

                            <div class="col-md-6">
                                <input id="institution" type="text" class="form-control" name="institution" value="{{ old('institution') }}" autocomplete="institution">

                                @error('institution')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          {!! Form::label('project_id', trans('global.users.fields.project').'', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">

                                {!! Form::select('project_id', $projects, old('project_id'), ['class' => 'form-control select2']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('project_id'))
                                    <p class="help-block">
                                        {{ $errors->first('project_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          {!! Form::label('professional_category_id', trans('global.users.fields.professional-category').'', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">

                                {!! Form::select('professional_category_id', $professional_categories, old('professional_category_id'), ['class' => 'form-control select2']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('professional_category_id'))
                                    <p class="help-block">
                                        {{ $errors->first('professional_category_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          {!! Form::label('education_id', trans('global.users.fields.education').'', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">

                                {!! Form::select('education_id', $education, old('education_id'), ['class' => 'form-control select2']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('education_id'))
                                    <p class="help-block">
                                        {{ $errors->first('education_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          {!! Form::label('country_id', trans('global.users.fields.country').'', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">

                                {!! Form::select('country_id', $countries, old('country_id'), ['class' => 'form-control select2']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('country_id'))
                                    <p class="help-block">
                                        {{ $errors->first('country_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          {!! Form::label('account_reason', trans('global.users.fields.account-reason-registration-form').'', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">

                                {!! Form::textarea('account_reason', old('account_reason'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('account_reason'))
                                    <p class="help-block">
                                        {{ $errors->first('account_reason') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
@endsection
