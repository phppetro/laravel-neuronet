@extends('layouts.app')

@section('content')

	<div id="root">
    	<div class="row">
  	    <div class="col-md-4">
      		@include('admin.dashboard2.activity3')
			@include('admin.dashboard2.projects')
            @include('admin.dashboard2.documents2')
      	</div>
		<div class="col-md-8">
			@include('admin.dashboard2.metrics4')
            @include('admin.dashboard2.schedule2')
		</div>
		<div class="col-md-4">
            @include('admin.dashboard2.asset_map')
            @include('admin.dashboard2.decision_tool')
            @include('admin.dashboard2.network')
            @include('admin.dashboard2.calendar2')
{{--            @include('admin.dashboard2.key_areas')--}}
		</div>
		<div class="col-md-4">
            @include('admin.dashboard2.publications2')
			@include('admin.dashboard2.deliverables3')
            @include('admin.dashboard2.tools')
        </div>
     </div>
  </div>

@endsection
