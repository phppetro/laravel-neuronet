@extends('layouts.app')

@section('content')

	<div id="root">

    	<div class="row">
    	    <div class="col-md-4">
        		@include('dashboard2.activity2')
        		@include('dashboard2.contacts')
        		@include('dashboard2.documents2')
            </div>
    		<div class="col-md-4">
    			@include('dashboard2.metrics4')
    			@include('dashboard2.schedule2')
    			@include('dashboard2.publications2')
    		</div>
    		<div class="col-md-4">
    			@include('dashboard2.calendar')
    			@include('dashboard2.deliverables3')
            </div>
         </div>
        
    </div>

@endsection