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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart-responsive">
                                    <div class="row text-center highlight-text highlight-img">
                                        <div class="col-md-3">
                                            <img src="img/brain.png" alt="Neurodegeneration projects">
                                            <div id="high-projects" class="highlight-num">18</div>
                                            <div>Neurodegeneration projects</div>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="img/euro.png" alt="Investment">
                                            <div id="high-investment" class="highlight-num">386</div>
                                            <div>Million €</div>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="img/book.png" alt="Research Publications">
                                            <div id="high-publications" class="highlight-num">350</div>
                                            <div>Research Publications</div>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="img/science.png" class="highlight-img-assets" alt="Assets">
                                            <div id="high-assets" class="highlight-num">45</div>
                                            <div>Assets</div>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="img/people.png" alt="Individuals">
                                            <div id="high-individuals" class="highlight-num">2300</div>
                                            <div>Individuals</div>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="img/building.png" alt="Organisations">
                                            <div id="high-organisations" class="highlight-num">239</div>
                                            <div>Organisations</div>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="img/earth.png" alt="Countries">
                                            <div id="high-countries" class="highlight-num">25</div>
                                            <div>Countries</div>
                                        </div>
                                    </div>
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

            const obj_projects = document.getElementById("high-projects");
            animateValue(obj_projects, 0, 18, 1000);

            const obj_investment = document.getElementById("high-investment");
            animateValue(obj_investment, 0, 386, 1000);

            const obj_publications = document.getElementById("high-publications");
            animateValue(obj_publications, 0, 350, 1000);

            const obj_assets = document.getElementById("high-assets");
            animateValue(obj_assets, 0, 45, 1000);

            const obj_individuals = document.getElementById("high-individuals");
            animateValue(obj_individuals, 0, 2300, 1000);

            const obj_organisations = document.getElementById("high-organisations");
            animateValue(obj_organisations, 0, 239, 1000);

            const obj_countries = document.getElementById("high-countries");
            animateValue(obj_countries, 0, 25, 1000);
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
