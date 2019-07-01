            <div class="box box-indigo">
                <div class="box-header with-border ui-sortable-handle">
                  <h3 class="box-title">Schedule</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div id="timeline" ></div>
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
              dataTable.addColumn({ type: 'date', id: 'Start' });
              dataTable.addColumn({ type: 'date', id: 'End' });
              dataTable.addRows([
                [ '1', 'ADAPTED', new Date(2016, 9, 1), new Date(2019, 8, 30) ],
                [ '2', 'AETIONOMY', new Date(2014, 1, 1), new Date(2018, 12, 31) ],
                [ '3', 'AMYPAD', new Date(2016, 9, 30), new Date(2021, 9, 30) ],
                [ '4', 'EMIF-AD', new Date(2013, 1, 1), new Date(2018, 6, 30) ],
                [ '5', 'EPAD', new Date(2015, 1, 1), new Date(2019, 12, 31) ],
                [ '6', 'EQIPD', new Date(2017, 9, 30), new Date(2020, 9, 30) ],
                [ '7', 'IM2PACT', new Date(2019, 1, 1), new Date(2023, 12, 31) ],
                [ '8', 'IMPRIND', new Date(2017, 1, 1), new Date(2021, 9, 30) ],
                [ '9', 'MOPEAD', new Date(2016, 9, 30), new Date(2019, 9, 30) ],
                [ '10', 'PD-MITOQUANT', new Date(2019, 1, 1), new Date(2021, 12, 31) ],
                [ '11', 'PHAGO', new Date(2016, 9, 30), new Date(2021, 9, 30) ],
                [ '12', 'PRISM', new Date(2016, 3, 30), new Date(2019, 12, 31) ],
                [ '13', 'RADAR-CNS', new Date(2016, 3, 30), new Date(2021, 3, 30) ],
                [ '14', 'RADAR-AD', new Date(2019, 1, 1), new Date(2022, 6, 30) ],
                [ '15', 'ROADMAP', new Date(2016, 9, 30), new Date(2018, 12, 31) ]]);

                var options = {
                  //title: 'Rate the Day on a Scale of 1 to 10',
                  height: 614,
                  hAxis: {
                    format: 'yyyy',
                    title: 'time',
                    gridlines: {count: 4}
                  },
                  timeline: {
                    showBarLabels: true,
                    showRowLabels: false,
                    rowLabelStyle: { fontSize: 11 },
                    barLabelStyle: { fontSize:11 }
                  },
                  tooltip: {
                    trigger: focus //none
                  },
                  colors: ['#3a0961', '#9b6deb'],
                  backgroundColor: '#fff'
                };

              chart.draw(dataTable, options);
              }
            </script>
