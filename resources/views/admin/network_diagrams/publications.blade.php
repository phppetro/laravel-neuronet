@extends('layouts.app')

@section('content')
    <div class="nav-tabs-custom" style="cursor: move;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
            <li class="pull-left header" style="padding:10px;">Network diagram of collaborating organisations on publications</li>
        </ul>
        <div class="tab-content no-padding">
            <div class="chart tab-pane active">
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                                <img class="img-responsive" style="padding-right:10px;padding-bottom:10px;float:left;" src="/img/collaborators.png" alt="Network diagram of collaborating organisations on publications">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
                                <div class="jumbotron">
                                    <p style="padding-right: 4%;padding-left: 4%;">The figure shows the network of collaborating organisations on project publications. Each node in the network represents a single organisation, with the size of the node reflecting the number of other organisations in the network that an organisation has published with. The lines connecting the nodes are coloured to represent the number of publications which connect individual organisations. The majority of connections in the network are coloured pink indicating that 2 organisations have appeared on 1 publication together. The connections between organisations that have co-authored multiple publications together are indicated in blue.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
