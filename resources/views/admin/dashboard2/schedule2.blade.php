            <div class="box box-indigo">
                <div class="box-header with-border ui-sortable-handle">
                  <h3 class="box-title">Schedule</h3>

{{--                  <div class="box-tools pull-right">--}}
{{--                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
{{--                  </div>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive" id="timeline" ></div>
                </div>
                <!-- /.box-body -->
            </div>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script>
              google.charts.load('current', {'packages':['timeline']});
              google.charts.setOnLoadCallback(drawChart);
              function drawChart() {
              var container = document.getElementById('timeline');
              var chart = new google.visualization.Timeline(container);
              var dataTable = new google.visualization.DataTable();

              dataTable.addColumn({ type: 'string', id: 'Role' });
              dataTable.addColumn({ type: 'string', id: 'Name' });
              dataTable.addColumn({ type: 'string', role: 'tooltip', 'p': {'html': true} });
              dataTable.addColumn({ type: 'date', id: 'Start' });
              dataTable.addColumn({ type: 'date', id: 'End' });
              dataTable.addRows([
                @foreach ($scheduleprojects as $project)
                  [ '{{ $loop->index+1 }}',
                    '{{ $project->name }}',

                    `<div class=""
                      style="width: 170px; height: 110px; left: 348.303px; top: 184.396px; pointer-events: none;">
                        <ul class="google-visualization-tooltip-item-list" style="">
                          <li class="google-visualization-tooltip-item" style="">
                            <span style="font-family: Arial; font-size: 12px; color: rgb(0, 0, 0); opacity: 1; margin: 0px; text-decoration: none; font-weight: bold;">{{ $project->name }}</span>
                          </li>
                        </ul>
                      <div class="google-visualization-tooltip-separator" style=""></div>
                      <ul class="google-visualization-tooltip-action-list" style="">
                        <li class="google-visualization-tooltip-action" style="">
                          <span style="font-family: Arial; font-size: 12px; color: rgb(0, 0, 0); opacity: 1; margin: 0px; text-decoration: none; font-weight: bold;">Start Date:</span>
                          <span style="font-family: Arial; font-size: 12px; color: rgb(0, 0, 0); opacity: 1; margin: 0px; text-decoration: none;"> {{ $project->start_date }}</span>
                        </li>
                        <li class="google-visualization-tooltip-action" style="">
                          <span style="font-family: Arial; font-size: 12px; color: rgb(0, 0, 0); opacity: 1; margin: 0px; text-decoration: none; font-weight: bold;">End Date:</span>
                          <span style="font-family: Arial; font-size: 12px; color: rgb(0, 0, 0); opacity: 1; margin: 0px; text-decoration: none;">{{ $project->end_date }}</span>
                        </li>
                      </ul>
                    </div>`,

                    new Date({{ date('Y, m, d', strtotime($project->start_date)) }}),
                    new Date({{ date('Y, m, d', strtotime($project->end_date)) }}) ],
                @endforeach
              ]);

                var options = {
                  //title: 'Rate the Day on a Scale of 1 to 10',
                  height: 764,
                  width: 600,
                  hAxis: {
                    format: 'yyyy',
                    title: 'time',
                    gridlines: {count: -1}
                  },
                  timeline: {
                    showBarLabels: true,
                    showRowLabels: false,
                    rowLabelStyle: { fontSize:11 },
                    barLabelStyle: { fontSize:11 }
                  },
                  tooltip: {
                    // trigger: focus //none
                  },
                  colors: ['#3a0961', '#e50e6a'],
                  backgroundColor: '#fff'
                };

              chart.draw(dataTable, options);
              }
            </script>
