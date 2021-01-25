<div class="nav-tabs-custom" style="cursor: move;">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right ui-sortable-handle">
              <li class="active"><a href="#highlights" data-toggle="tab" aria-expanded="true">Highlights</a></li>
              <li class=""><a href="#partners-chart" data-toggle="tab" aria-expanded="true">Partners</a></li>
              <li class=""><a href="#funding-chart" data-toggle="tab" aria-expanded="false">Funding in M&#8364;</a></li>
              <li class=""><a href="#countries-chart" data-toggle="tab" aria-expanded="true">Participating Countries</a></li>
              <li class="pull-left header">Metrics</li>
            </ul>
            <div class="tab-content no-padding">

              <div class="chart tab-pane" id="countries-chart">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart-responsive">
                                    <canvas id="bar-chart-2" width="800" height="400"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>

              <div class="chart tab-pane" id="funding-chart">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive">
                        <canvas id="bar-chart" width="800" height="400"></canvas>
                      </div>
                      <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->
              </div>

              <div class="chart tab-pane" id="partners-chart">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive">
                        <canvas id="pie-chart" width="800" height="400"></canvas>
                      </div>
                      <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->
              </div>

                <div class="chart tab-pane active" id="highlights">
                    <div class="box-body">
                        <div class="row highlight-padding">
                            <div class="col-md-3 highlight-text-big" style="padding-top:3%;">
                                <div class="chart-responsive text-center">
                                    <img src="img/{{ $highlightsmetrics[0]->image }}" alt="{{ $highlightsmetrics[0]->name }}">
                                    <div id="highlights-{{ $highlightsmetrics[0]->order }}" class="highlight-num">{{ $highlightsmetrics[0]->number }}</div>
                                    <div>{{ $highlightsmetrics[0]->name }}</div>
                                </div>
                            </div>
                            <div class="col-md-3 highlight-text-big">
                                <div class="chart-responsive">
                                    <div class="row text-center" style="padding-top:9%;">
                                        <div class="col-md-6">
                                            <img src="img/{{ $highlightsmetrics[1]->image }}" alt="{{ $highlightsmetrics[1]->name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <div id="highlights-{{ $highlightsmetrics[1]->order }}" class="highlight-num highlight-num-med">{{ $highlightsmetrics[1]->number }}</div>
                                            <div>{{ $highlightsmetrics[1]->name }}</div>
                                        </div>
                                    </div>
                                    <div class="row text-center" style="padding-top:24%;">
                                        <div class="col-md-6">
                                            <img class="highlight-img-med" src="img/{{ $highlightsmetrics[5]->image }}" alt="{{ $highlightsmetrics[5]->name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <div style="padding-top:45%;" id="highlights-{{ $highlightsmetrics[5]->order }}" class="highlight-num">{{ $highlightsmetrics[5]->number }}</div>
                                            <div>{{ $highlightsmetrics[5]->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 highlight-text-small">
                                <div class="chart-responsive text-center">
                                    <img class="highlight-img-small" src="img/{{ $highlightsmetrics[6]->image }}" alt="{{ $highlightsmetrics[6]->name }}">
                                    <div id="highlights-{{ $highlightsmetrics[6]->order }}" class="highlight-num">{{ $highlightsmetrics[6]->number }}</div>
                                    <div class="highlight-name-small">{{ $highlightsmetrics[6]->name }}</div>

                                    <img class="highlight-img-small" src="img/{{ $highlightsmetrics[4]->image }}" alt="{{ $highlightsmetrics[4]->name }}">
                                    <div id="highlights-{{ $highlightsmetrics[4]->order }}" class="highlight-num">{{ $highlightsmetrics[4]->number }}</div>
                                    <div class="highlight-name-small">{{ $highlightsmetrics[4]->name }}</div>
                                </div>
                            </div>
                            <div class="col-md-3 highlight-text-small">
                                <div class="chart-responsive text-center">
                                    <img class="highlight-img-small" src="img/{{ $highlightsmetrics[2]->image }}" alt="{{ $highlightsmetrics[2]->name }}">
                                    <div id="highlights-{{ $highlightsmetrics[2]->order }}" class="highlight-num">{{ $highlightsmetrics[2]->number }}</div>
                                    <div class="highlight-name-small">{{ $highlightsmetrics[2]->name }}</div>

                                    <img class="highlight-img-small" src="img/{{ $highlightsmetrics[3]->image }}" alt="{{ $highlightsmetrics[3]->name }}">
                                    <div id="highlights-{{ $highlightsmetrics[3]->order }}" class="highlight-num">{{ $highlightsmetrics[3]->number }}</div>
                                    <div class="highlight-name-small">{{ $highlightsmetrics[3]->name }}</div>
                                </div>
                            </div>
                        </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>

        <script>
            function animateValue(obj, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }
            @foreach($highlightsmetrics as $highlightsmetric )
                const obj_projects_{{ $highlightsmetric->order }} = document.getElementById("highlights-{{ $highlightsmetric->order }}");
                animateValue(obj_projects_{{ $highlightsmetric->order }}, 0, {{ $highlightsmetric->number }}, 1000);
            @endforeach
        </script>

          <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
          <script>
            new Chart(document.getElementById("bar-chart-2"), {
              type: 'bar',
              data: {
                labels: [
                  @foreach ($countriesmetrics as $countriesmetric)
                    "{{ $countriesmetric->name }}",
                  @endforeach
                ],
                datasets: [{
                    data: [
                      @foreach ($countriesmetrics as $countriesmetric)
                        "{{ $countriesmetric->number }}",
                      @endforeach
                    ],
                    label: "Count",
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
                  display: true,
                  text: 'Number of organizations',
                    position: 'left'
                },
                legend: {
                  display: false,
                  text: 'legend',
                    position: 'bottom'
                }
              }
            });

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
                        label: "Funding in M€",
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
                        display: true,
                        text: 'Funding in M€',
                        position: 'left'
                    },
                    legend: {
                        display: false,
                        text: 'IMI Projects',
                        position: 'bottom'
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
                  text: 'Partners by sector',
                  position: 'top'
                },
                legend: {
                  display: true,
                    position: 'right'
                }
              }
            });

          </script>
