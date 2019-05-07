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
                @foreach($policies as $policy)
                  <h2 class="pb-4">{{ $policy->title }}</h2>
                  {!! $policy->page_text !!}
                @endforeach
              </div>
          	</div>
      </div>
    </section>

    <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <a href="https://europa.eu/european-union/index_en">
            <img class="img-fluid d-block mx-auto" src="img/eu-logo.png" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6">
          <a href="https://www.imi.europa.eu/">
            <img class="img-fluid d-block mx-auto" src="img/imi-logo.png" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6">
          <a href="https://www.efpia.eu/">
            <img class="img-fluid d-block mx-auto" src="img/efpia-logo.png" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6">
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
