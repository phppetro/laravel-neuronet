<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <style>
        .content-wrapper {
            margin-left: 0px;
            background-color: #fff;
        }
    </style>
</head>

@can('sidebar_layout')
  <body class="hold-transition skin-black-light sidebar-mini">
  <div id="wrapper">
{{--  @include('partials.topbar')--}}
{{--  @include('partials.sidebar')--}}
@endcan

@can('topbar_layout')
  <body class="layout-top-nav skin-black-light">
  <div id="wrapper">
{{--  @include('partials.topbar-only')--}}
@endcan

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            @if(isset($siteTitle))
                <h3 class="page-title">
                    {{ $siteTitle }}
                </h3>
            @endif

            <div class="row">
                <div class="col-md-12">

{{--                    @if (Session::has('message'))--}}
{{--                        <div class="alert alert-info">--}}
{{--                            <p>{{ Session::get('message') }}</p>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @if ($errors->count() > 0)--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul class="list-unstyled">--}}
{{--                                @foreach($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}

                    @yield('content')

                </div>
            </div>
        </section>
    </div>
</div>

{{--{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}--}}
{{--<button type="submit">Logout</button>--}}
{{--{!! Form::close() !!}--}}

@include('partials.javascripts')
</body>
</html>
