<div class="nav-tabs-custom" style="cursor: move;">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs pull-right ui-sortable-handle">
{{--      <li class="active"><a href="#projects" data-toggle="tab" aria-expanded="true">Projects</a></li>--}}
{{--      <li class=""><a href="#participants" data-toggle="tab" aria-expanded="true">Participants</a></li>--}}
{{--      <li class=""><a href="#publications" data-toggle="tab" aria-expanded="false">Publications</a></li>--}}
      <li class="pull-left header">Network Diagrams</li>
      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
              <span id="selected-diagram">Projects </span><span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <li role="presentation">
                  <a onClick="diagramMenu(this);" role="menuitem" tabindex="-1" data-toggle="tab" aria-expanded="false"
                     href="#projects">Projects
                  </a>
              </li>
              <li role="presentation">
                  <a onClick="diagramMenu(this);" id="participants-diagram" role="menuitem" tabindex="-1"
                     data-toggle="tab" aria-expanded="false" href="#participants">Participants
                  </a>
              </li>
              <li role="presentation">
                  <a onClick="diagramMenu(this);" id="publications-diagram" role="menuitem" tabindex="-1"
                     data-toggle="tab" aria-expanded="false" href="#publications">Publications
                  </a>
              </li>
          </ul>
      </li>
    </ul>
    <div class="tab-content no-padding">
      <div class="chart tab-pane active" id="projects">
        <div class="box-body">
            <div class="table-responsive network-participants-image">
                <h4>Network diagram of projects in the portfolio</h4>
                <p class="network-diagram hidden">The figure represents the network of IMI projects that form the IMI neurodegeneration portfolio. Each node in the network represents an IMI project. The lines between the nodes are weighted to show the number of organisations that participate in both projects – the wider the connection, the higher the number of shared organisations between projects.</p>
                <img class="img-responsive" src="/img/projects.png" alt="Asset map">
            </div>
        </div>
        <!-- /.box-body -->
      </div>

      <div class="chart tab-pane" id="participants">
        <div class="box-body">
            <div class="table-responsive network-participants-image">
                <h4>Network diagram of organisations participating in the portfolio</h4>
                <p class="network-diagram hidden">The figure represents the network of unique partner organisations that participate in the 18 projects of the IMI neurodegeneration portfolio (N=239). Each organisation is represented by a single node, where the size of each node reflects how well connected an organisation is with all other organisations in the network. The figure shows that there are a relatively small number of organisations that are the key nodes in the network. The lines connecting the nodes are coloured to represent the number of projects that connect individual organisations. The majority of connections in the network are coloured orange indicating that 2 organisations are connected through participation in a single project. The connections between organisations that participate together in multiple projects are indicated in blue.</p>
                <img class="img-responsive network-participants-image" src="/img/participants.png" alt="Asset map">
            </div>
        </div>
        <!-- /.box-body -->
      </div>

      <div class="chart tab-pane" id="publications">
        <div class="box-body">
            <div class="table-responsive network-participants-image">
                <h4>Network diagram of collaborating organisations on publications</h4>
                <p class="network-diagram hidden">The figure shows the network of collaborating organisations on project publications. Each node in the network represents a single organisation, with the size of the node reflecting the number of other organisations in the network that an organisation has published with. The lines connecting the nodes are coloured to represent the number of publications which connect individual organisations. The majority of connections in the network are coloured orange indicating that 2 organisations have appeared on 1 publication together. The connections between organisations that have co-authored multiple publications together are indicated in blue.</p>
                <img class="img-responsive" src="/img/collaborators.png" alt="Asset map">
            </div>
        </div>
        <!-- /.box-body -->
      </div>

    </div>
</div>

@section('javascript')
    <script type="text/javascript">
        $(".network-participants-image").hover(function() {
            $('.network-diagram').removeClass('hidden')
        }, function() {
            $('.network-diagram').addClass('hidden')
        });

        $(function () {
            diagramMenu = function (elm) {
                $('#selected-diagram')[0].innerHTML = $(elm)[0].innerHTML;
            }
        });

        $(".project-name").hover(function () {
            $(this).find(".project-title").toggleClass('hidden');
        })
    </script>
@stop
