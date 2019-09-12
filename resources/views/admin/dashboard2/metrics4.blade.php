<div class="nav-tabs-custom" style="cursor: move;">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right ui-sortable-handle">
              <li class="active"><a href="#revenue-chart" data-toggle="tab" aria-expanded="true">Partners</a></li>
              <li class=""><a href="#sales-chart" data-toggle="tab" aria-expanded="false">Funding in &#8364;</a></li>
              <li class="pull-left header">Metrics</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane" id="sales-chart">


                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive">
                        <canvas id="bar-chart" width="400" height="305"></canvas>
                      </div>
                      <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->


              </div>
              <div class="chart tab-pane active" id="revenue-chart">


                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive">
                        <canvas id="pie-chart" width="400" height="305"></canvas>
                      </div>
                      <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->


              </div>
            </div>
          </div>

          <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
          <script>
            new Chart(document.getElementById("bar-chart"), {
              type: 'bar',
              data: {
                labels: [
                  @foreach ($projectsmetrics as $projectsmetric)
                    "{{ $projectsmetric->name }}",
                  @endforeach
                ],
                datasets: [{
                    data: [
                      @foreach ($projectsmetrics as $projectsmetric)
                        "{{ $projectsmetric->funding }}",
                      @endforeach
                    ],
                    label: "Project funding",
                    borderColor: "rgba(58,9,97,1)",
                    backgroundColor: "rgba(58,9,97,0.75)",
                    "borderWidth":2,
                    borderSkipped: "right",
                    fill: true
                  }
                ]
              },
              options: {
                title: {
                  display: false,
                  text: ''
                },
                legend: {
                  display: false
                }
              }
            });


            new Chart(document.getElementById("pie-chart"), {
              type: 'doughnut',
              data: {
                datasets: [{
                  data: [
                    @foreach($partnersmetrics as $partnersmetric)
                      "{{ $partnersmetric->number }}",
                    @endforeach
                  ],
                  backgroundColor: [
                    @foreach($colors as $color)
                      "{{ $color }}",
                    @endforeach
                  ],
                  label: "Dataset 1",
                }],
                labels: [
                  @foreach($partnersmetrics as $partnersmetric)
                    "{{ $partnersmetric->name }}",
                  @endforeach
                ]
              },
              options: {
                title: {
                  display: false,
                  text: ''
                },
                legend: {
                  display: true
                }
              }
            });

          </script>
