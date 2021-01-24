@extends('layouts.front')

@section('content')
    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
        </div>
      </div>
    </header>

    <section id="services">
      <div class="container">
          	<div class="row">
          		<div class="col-lg-12">
                @foreach($homes as $home)
                  <h2 class="pb-4">{{ $home->title }}</h2>
                  {!! $home->page_text !!}
                @endforeach
              </div>
          	</div>
      </div>
    </section>

    <section class="bg-light" id="team">
        <div class="container">
            <div class="row">
                @foreach($teams as $team)
                    <div class="col-sm-6 col-md-6 col-lg-3 team-member-padding">
                        <img class="img-responsive img-fluid" alt="{!! $team->title !!}" src="/img/{!! $team->featured_image !!}" />
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 team-member-padding">
                        {!! $team->page_text !!}
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="container" id="funding">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            @foreach($fundings as $funding)
              {!! $funding->page_text !!}
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <section class="pt-0">
    <div class="container">
      <div class="row">
        <div class=" col-sm-6 col-md-3 py-4">
          <a href="https://europa.eu/european-union/index_en">
            <img class="img-fluid d-block mx-auto" src="img/eu-logo.png" alt="">
          </a>
        </div>
        <div class="col-sm-6 col-md-3 py-4">
          <a href="https://www.imi.europa.eu/">
            <img class="img-fluid d-block mx-auto" src="img/imi-logo.png" alt="">
          </a>
        </div>
        <div class="col-sm-6 col-md-3 py-4">
          <a href="https://www.efpia.eu/">
            <img class="img-fluid d-block mx-auto" src="img/efpia-logo.png" alt="">
          </a>
        </div>
        <div class="col-sm-6 col-md-3 py-4">
          <a href="https://www.parkinsons.org.uk/">
            <img class="img-fluid d-block mx-auto" src="img/parkinsonsuk-logo.png" alt="">
          </a>
        </div>
      </div>
    </div>
  </section>


    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            @foreach($helps as $help)
              <h4 class="section-heading text-uppercase">{{ $help->title }}</h4>
              {!! $help->page_text !!}
            @endforeach
          </div>
        </div>
      </div>
    </section>
@endsection
