@extends('layouts.app')

@section('content')
    <h3 class="page-title">Regulatory and HTA engagement – Decision Tool Framework</h3>
    <div class="decision-image">
        <div class="decision-top"></div>
        <div class="decision-ema">
            <div class="decision-ema-1" data-toggle="modal" data-target="#ema-1"></div>
            <div class="decision-ema-2" data-toggle="modal" data-target="#ema-2"></div>
            <div class="decision-ema-3" data-toggle="modal" data-target="#ema-3"></div>
            <div class="decision-ema-4" data-toggle="modal" data-target="#ema-4"></div>
        </div>
        <div class="decision-qualification">
            <div class="decision-qualification-1" data-toggle="modal" data-target="#qualification-1"></div>
        </div>
        <div class="decision-advice">
            <div class="decision-advice-1" data-toggle="modal" data-target="#advice-1"></div>
        </div>
        <div class="decision-protocol">
            <div class="decision-protocol-1" data-toggle="modal" data-target="#protocol-1"></div>
            <div class="decision-protocol-2" data-toggle="modal" data-target="#protocol-2"></div>
            <div class="decision-protocol-3" data-toggle="modal" data-target="#protocol-3"></div>
            <div class="decision-protocol-4" data-toggle="modal" data-target="#protocol-4"></div>
        </div>
        <div class="decision-assistance">
            <div class="decision-assistance-1" data-toggle="modal" data-target="#assistance-1"></div>
            <div class="decision-assistance-2" data-toggle="modal" data-target="#assistance-2"></div>
            <div class="decision-assistance-3" data-toggle="modal" data-target="#assistance-3"></div>
            <div class="decision-assistance-4" data-toggle="modal" data-target="#assistance-4"></div>
        </div>
        <div class="decision-informal">
            <div class="decision-informal-1" data-toggle="modal" data-target="#informal-1"></div>
        </div>
        <div class="decision-mechanism">
            <div class="decision-mechanism-1" data-toggle="modal" data-target="#mechanism-1"></div>
        </div>
    </div>

    @foreach($decision_tools as $decision_tool)

        <!-- Modal -->
        <div class="modal fade" id="{{ $decision_tool->target }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{ $decision_tool->title }}</h4>
                    </div>
                    <div class="modal-body">
                        {!! $decision_tool->body !!}
                    </div>
                </div>
            </div>
        </div>

    @endforeach

@endsection
