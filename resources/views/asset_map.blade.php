@extends('layouts.embed')

@section('content')
    <h3 class="page-title">Assets Map</h3>
    {{--<img  src="/img/assets_map6.png" usemap="#image-map">--}}

    {{--<map name="image-map">--}}
        {{--<area class="asset-122" data-toggle="modal" data-target="#ema-1" style="background-color:blue;" alt="google" title="google" href="#ema-1" coords="708,98,589,155" shape="rect">--}}
    {{--</map>--}}

    <div class="asset-image">
        @foreach($asset_maps as $asset_map)
            <div class="{{ $asset_map->target }} || " data-toggle="modal" data-target="#{{ $asset_map->target }}"><span class="asset-title">{{ $asset_map->title }}</span></div>
        @endforeach
    </div>

    <!-- Modal -->
    @foreach($asset_maps as $asset_map)
        <div class="modal fade" id="{{ $asset_map->target }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><img class="modal-img" src="/{{ $asset_map->project->logo }}">{{ $asset_map->title }}</h4>
                    </div>
                    <div class="modal-body">
                        {!! $asset_map->body !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
