@extends('layouts.app')

@section('content')

	<div id="root">
    	<div class="row">
  	    <div class="col-md-4">
      		@include('admin.dashboard2.activity2')
      		@include('admin.dashboard2.contacts')
			@include('admin.dashboard2.projects')
      	</div>
		<div class="col-md-8">
			@include('admin.dashboard2.metrics4')
		</div>
		<div class="col-md-4">
			@include('admin.dashboard2.publications2')
			@include('admin.dashboard2.documents2')
			@include('admin.dashboard2.calendar2')
			@include('admin.dashboard2.tools')
			@include('admin.dashboard2.asset_map')
		</div>
		<div class="col-md-4">
			@include('admin.dashboard2.schedule2')
			@include('admin.dashboard2.deliverables3')
			@include('admin.dashboard2.decision_tool')
        </div>
     </div>
  </div>

@endsection
