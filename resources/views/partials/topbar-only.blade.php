<header class="main-header">
    <nav class="navbar navbar-static-top">

      <div class="navbar-header">
        <a href="{{ url('/admin/') }}" class="navbar-brand"><img class="neuronet-logo-lg" src="/img/Neuronet_Logo.png"></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <div class="navbar-collapse pull-left collapse" id="navbar-collapse" aria-expanded="false" style="height: 1px;">
        <ul class="nav navbar-nav">
          <li><a class="dashboard" href="/admin/">Dashboard <span class="sr-only">(current)</span></a></li>
        </ul>
      </div>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            @include('partials.user-menu')

          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
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
