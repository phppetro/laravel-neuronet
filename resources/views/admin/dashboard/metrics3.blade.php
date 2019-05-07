			<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Metrics <span class="small text-muted">(Sample metrics graph)</span></h3>
    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive">
                        <canvas id="metric3-chart" width="400" height="305"></canvas>
                      </div>
                      <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
		
			<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        	<script>
        		new Chart(document.getElementById("metric3-chart"), {
        		  type: 'doughnut',
        		  data: {
        		    labels: [
                        @foreach ($projects as $group => $result)
                        "{{ $group }}",
                    	@endforeach
        			],
        		    datasets: [{ 
        		        data: [
        	                @foreach ($project_sums as $group => $result)
        	                "{{ $result }}",
        	            	@endforeach
        				],
        		        borderColor: [
        		        	@foreach ($colors as $color)
                            "{{ $color }}",
                        	@endforeach
        		        ],
        		        backgroundColor: [
        		        	@foreach ($colors as $color)
                            "{{ $color }}",
                        	@endforeach
            		    ],
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
        		    }
        		  }
        		});
        	</script>