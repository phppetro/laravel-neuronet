@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            @include('dashboard.activity')
            @include('dashboard.publications')
            @include('dashboard.contacts')
        </div>
        <div class="col-md-4">
            @include('dashboard.metrics3')
            @include('dashboard.deliverables')
            @include('dashboard.documents')
        </div>
        <div class="col-md-4">
            @include('dashboard.resources')
            @include('dashboard.schedule')
            @include('dashboard.metrics')   
        </div>

    </div>
    
@endsection
