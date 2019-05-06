<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/') }}" class="logo"
       style="font-size: 16px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img class="neuronet-logo-mini" src="/img/Neuronet_Isotipo.png"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img class="neuronet-logo-lg" src="/img/Neuronet_Logo.png"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Messages: style can be found in dropdown.less-->
              <li class="home-menu">
                <a href="/">
                  <i class="fa fa-home"></i>
                </a>
              </li>

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/thumb/{{ Auth::user()->photo ? Auth::user()->photo : "place_holder.jpg" }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/thumb/{{ Auth::user()->photo ? Auth::user()->photo : "place_holder.jpg" }}" class="img-circle" alt="User Image">

                    <p>
                      {{ Auth::user()->name }}
                      <small>Member since {{ Auth::user()->created_at->format('F Y') }}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="/admin/users/{{ Auth::user()->id }}/edit" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#logout" onclick="$('#logout').submit();" class="btn btn-default btn-flat">@lang('global.app_logout')</a>
                    </div>



                  </li>
                </ul>
              </li>

            <!--
                <li class="dropdown languages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(\App::getLocale()) }}
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"></li>
                        <ul class="menu language-menu">
                            @foreach(config('app.languages') as $short => $title)
                                <li class="language-link">
                                    <a href="{{ route('admin.language', $short) }}">
                                        {{ $title }} ({{ strtoupper($short) }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <li class="footer"></li>
                    </ul>
                </li>
              -->
            </ul>
        </div>
    </nav>
</header>


    </nav>
</header>


<style>
    .slimScrollDiv {
        width: auto !important;
        height:auto !important;
    }

    .language-menu {
        width: auto !important;
        list-style-type: none;
        padding: 0;
        margin: 0;
        max-width: 300px;
        height:auto !important;
        max-height: 500px !important;
    }

    .language-link {
        width: auto;
    }

    .language-link a {
        display: block;
        width: 100%;
        white-space: normal !important;
        padding: 5px;
    }
    .language-link a:hover {
        color: #389ad2;
        background: #f9f9f9;
    }
</style>
