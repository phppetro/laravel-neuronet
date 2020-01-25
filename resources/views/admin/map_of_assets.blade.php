@extends('layouts.app')

@section('content')
    <h3 class="page-title">Map of assets</h3>
    {{--<img  src="/img/map_of_assets6.png" usemap="#image-map">--}}

    {{--<map name="image-map">--}}
        {{--<area class="asset-122" data-toggle="modal" data-target="#ema-1" style="background-color:blue;" alt="google" title="google" href="#ema-1" coords="708,98,589,155" shape="rect">--}}
    {{--</map>--}}

    <div class="asset-image">
        <div class="asset-9-1" data-toggle="modal" data-target="#asset-9-1"></div>
        <div class="asset-9-2" data-toggle="modal" data-target="#asset-9-2"></div>
        <div class="asset-9-3" data-toggle="modal" data-target="#asset-9-3"></div>
        <div class="asset-9-4" data-toggle="modal" data-target="#asset-9-4"></div>
        <div class="asset-5" data-toggle="modal" data-target="#qualification-1"></div>
        <div class="asset-6" data-toggle="modal" data-target="#qualification-1"></div>
        <div class="asset-7" data-toggle="modal" data-target="#qualification-1"></div>
        <div class="asset-8" data-toggle="modal" data-target="#advice-1"></div>
        <div class="asset-9" data-toggle="modal" data-target="#advice-1"></div>
        <div class="asset-10" data-toggle="modal" data-target="#advice-1"></div>
        <div class="asset-11" data-toggle="modal" data-target="#advice-1"></div>
        <div class="asset-12" data-toggle="modal" data-target="#protocol-1"></div>
        <div class="asset-13" data-toggle="modal" data-target="#protocol-2"></div>
        <div class="asset-14" data-toggle="modal" data-target="#protocol-3"></div>
        <div class="asset-15" data-toggle="modal" data-target="#protocol-4"></div>
        <div class="asset-16" data-toggle="modal" data-target="#assistance-1"></div>
        <div class="asset-17" data-toggle="modal" data-target="#assistance-2"></div>
        <div class="asset-18" data-toggle="modal" data-target="#assistance-3"></div>
        <div class="asset-19" data-toggle="modal" data-target="#assistance-4"></div>
        <div class="asset-20" data-toggle="modal" data-target="#informal-1"></div>
        <div class="asset-21" data-toggle="modal" data-target="#mechanism-1"></div>
    </div>

    {{--@foreach($decision_tools as $decision_tool)--}}

        {{--<!-- Modal -->--}}
        {{--<div class="modal fade" id="{{ $decision_tool->target }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
            {{--<div class="modal-dialog" role="document">--}}
                {{--<div class="modal-content">--}}
                    {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                        {{--<h4 class="modal-title" id="myModalLabel">{{ $decision_tool->title }}</h4>--}}
                    {{--</div>--}}
                    {{--<div class="modal-body">--}}
                        {{--{!! $decision_tool->body !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--@endforeach--}}

    <div class="modal fade" id="asset-9-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Multi-omics data (transcriptomics, methylomics, proteomics, metabolomics)</h4>
                </div>
                <div class="modal-body">
                    <p>ADAPTED has collected RNA from iPSC-generated neurons, microglia, patient-derived monocytes and humanised APOE mouse models, and will collect RNA from iPSC-generated astrocytes and macrophages. Methylome analysis has been completed for patient-derived monocytes. Proteomics analysis has been completed for iPSC-derived astrocytes, iPSC-derived macrophages, iPSC-derived microglia, humanised APOE mouse models and MCI patients (from CSF and plasma). Metabolomics analysis has been completed for iPSC-derived neurons and astrocytes, MCI patients (CSF and plasma).  Data is available via a Jupyter notebook (no information available on location).</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="asset-9-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Neuroimaging data (PET/MRI) + CSF</h4>
                </div>
                <div class="modal-body">
                    <p>The aim of this component of WP3 is to perform imaging in AD patients to establish if the activation of microglia and
                        their response to a systemic challenge in vivo are similar in people with/without TREM2/CD33 disease risk variants and evaluate sTREM2 and other proteins in CSF as potential microglial biomarkers of neurodegeneration.   KCL will perform prospective human clinical Positron Emission Tomography (PET) scanning of neuroinflammation in 24 people to include 12 per group (MMSE=20) with/ without TREM2 R47H alleles. PHAGO will determine novel microglia related biomarkers in the CSF of AD patients using advanced mass spectrometry technologies for allowing a better monitoring of potential therapies</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="asset-9-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Animal data from multi-site experiments</h4>
                </div>
                <div class="modal-body">
                    <p>EQIPD will obtain study reports for historical data from EFPIA partners, CROs and academic labs, and calculate the prevalence of reporting of measures to increase internal validity. An initial survey of available datasets suggests availability for the Irwin test (47 experiments), Morris Water Maze (69), Y/T mazes (50), prepulse inhibition (56), novel object recognition tasks (35), and sleep/wake (72) and circadian (37) EEG.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="asset-9-4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Omics data on patient tissue and cellular disease models</h4>
                </div>
                <div class="modal-body">
                    <p>IM2PACT will identify genes or pathways candidates associated with neurodegenerative diseases and expressed in brain endothelial cells. To fulfil this aim IM2PACT will use genetic analyses of existing data (GWAS, others); transcriptomic, proteomic on patient primary cells or tissues; transcriptomic, proteomic on preclinical disease models primary cells and glycomics of BBB cells and/or cerebral vasculature of diseased brains.</p>
                </div>
            </div>
        </div>
    </div>

@endsection
