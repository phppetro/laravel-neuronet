<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NEURONET IMI NEURODEGENERATION KNOWLEDGE BASE (INKB)</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114202983-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-114202983-2');
    </script>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="/css/agency.css" rel="stylesheet">

    <link href="/css/style_front.css" rel="stylesheet">
	@yield('styles')
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-md fixed-topnavbar-light bg-white fixed-top navbar-shrink border-bottom shadow-lg" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/"><img class="img-fluid neuronet-logo" src="/img/Neuronet_Logo.png" alt="Harmony Data Anonymisation"></a>
        <button class="navbar-toggler navbar-toggler-right mt-2" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/"> Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/dashboard"> Dashboard </a>
            </li>
              @guest
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          @if(Auth::check())
                              <a href="{{ url('/admin/') }}" class="btn btn-default btn-flat"> Dashboard</a><br>
                          @endif

                          {!! Form::open(['route' => 'auth.logout', 'id' => 'logout']) !!}
                            <button class="btn btn-link btn-flat" type="submit">Logout</button>
                          {!! Form::close() !!}

                      </div>
                  </li>
              @endguest
          </ul>
        </div>
      </div>
    </nav>

@yield('content')

    <!-- Footer -->
    <footer>
      @include('partials.footer')
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="/js/jqBootstrapValidation.js"></script>
    <script src="/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/js/agency.js"></script>
	@yield('scripts')
  </body>

</html>
