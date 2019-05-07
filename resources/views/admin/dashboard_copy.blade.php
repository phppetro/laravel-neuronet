@extends('layouts.app')

@section('content')
    <div class="row">

      <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Activity</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
    			 <div class="box-body">
                    @foreach($posts as $post)
                        <div class="box-footer">
                          <div class="box-comment">
                            <div class="comment-text">
                                  <span class="username text-bold">
                                    {{ $post->user ? $post->user->name : "anonymous" }}
                                  </span><!-- /.username -->
                                  <span class="text-muted pull-right">{{ $post->created }}</span><br>
                              {{ $post->description }}
                              @can('post_view')
                              	  <a href="{{ route('admin.posts.show',[$post->id]) }}">@lang('global.app_read_more')</a>
                              @endcan
                            </div>
                            <!-- /.comment-text -->
                          </div>
    
                          <!-- /.box-comment -->
                        </div>
                    @endforeach
                </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ route('admin.posts.index') }}" class="uppercase">View All Activity</a>
            </div>
            <!-- /.box-footer -->
          </div>


        	<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Deliverables</h3>
    				
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Project</th>
                        <th>Status</th>
                      </tr>
                      </thead>
                      <tbody>
                      	@foreach($deliverables as $deliverable)
                          <tr>
                            <td><a href="{{ route('admin.deliverables.show',[$deliverable->id]) }}">{{ $deliverable->label_identification }}</a></td>
                            <td>{{ $deliverable->short_title }}</td>
                            <td>{{ $deliverable->project ? $deliverable->project->name : "no project" }}</td>
                            <td><span class=
                            
                               @switch($deliverable->status_id)
                                    @case(1)
                                        "label label-warning">{{ $deliverable->status->label }}
                                        @break
                                    @case(2)
                                        "label label-warning">{{ $deliverable->status->label }}
                                        @break
                                    @case(6)
                                        "label label-success">{{ $deliverable->status->label }}
                                        @break
                                    @case(5)
                                        "label label-danger">{{ $deliverable->status->label }}
                                        @break
                                    @default
                                    	"label label-info">no status
                                @endswitch
                            
                            </span></td>
                          </tr>
                      	@endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="{{ route('admin.deliverables.index') }}" class="uppercase">View All Deliverables</a>
                  </div>
                <!-- /.box-footer -->
              </div>
              
              
              
              
              
              
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Contacts</h3>
    				
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="tab-content">
                      
                     @foreach($members as $key=>$member)
                        <!-- Post -->
                        <div class="box-footer">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="https://pi.synapse-managers.com/img/user{{ $key+1 }}.jpg" alt="user image">
                                <span class="username">
                                  <a href="{{ route('admin.members.show',[$member->id]) }}">{{ $member->name }} {{ $member->surname }}</a>
                                </span>
                            <span class="description">{{ $member->partner ? $member->partner->name : 'no partners' }}</span>
                          </div>
                          <!-- /.user-block -->
                        </div>
                        <!-- /.post -->
                      @endforeach

                   </div>
                </div>
                <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="{{ route('admin.members.index') }}" class="uppercase">View All Contacts</a>
                  </div>
                <!-- /.box-footer -->
              </div>
          
          
        </div>   

    	<div class="col-md-4">
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
                        <canvas id="line-chart" width="800" height="580"></canvas>
                      </div>
                      <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            
            
            
             <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Publications</h3>
    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
        			 <div class="box-body">
                        @foreach($publications as $publication)
                            <div class="box-footer">
                              <div class="box-comment">
                                <div class="comment-text">
                                      <span class="username text-bold">
                                        {{ $publication->abbr ? $publication->abbr : "anonymous" }}
                                      </span><!-- /.username -->
                                      <span class="text-muted pull-right">{{ $publication->month }}-{{ $publication->year }}</span><br>
                                  <a href="{{ $publication->link }}" target="_blank">{{ $publication->title }}</a>
                                </div>
                                <!-- /.comment-text -->
                              </div>
        
                              <!-- /.box-comment -->
                            </div>
                        @endforeach
                    </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{ route('admin.publications.index') }}" class="uppercase">View All Publications</a>
                </div>
                <!-- /.box-footer -->
              </div>
              
              
               <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Documents</h3>
    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
        			 <div class="box-body">
                        @foreach($documents as $document)
                            <div class="box-footer">
                              <div class="box-comment">
                                <div class="comment-text">
                                      <span class="username text-bold">
                                        {{ $document->project ? $document->project->name : "no project" }} - 
                                      </span>
                                  <a href="https://synapse-pi.com/documents/download/{{ $document->id }}" target="_blank">{{ $document->title }}</a>
                                </div>
                                <!-- /.comment-text -->
                              </div>
        
                              <!-- /.box-comment -->
                            </div>
                        @endforeach
                    </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{ route('admin.documents.index') }}" class="uppercase">View All Documents</a>
                </div>
                <!-- /.box-footer -->
              </div>
            
            
            
		</div>
		
		<div class="col-md-4">
    		<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Schedule <span class="small text-muted">(Sample gantt chart)</span></h3>
    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                   <img src="https://pi.synapse-managers.com/img/gantt.png" class="img-thumbnail" alt="Responsive image">
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">EPAD
                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                <li><a href="#">AMYPAD <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                </li>
                <li><a href="#">MOPEAD
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
              </ul>
            </div>
            </div>
            
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total cost</span>
              <span class="info-box-number">5,200</span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
              <span class="progress-description">
                    50% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Mentions</span>
              <span class="info-box-number">92,050</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
              <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Downloads</span>
              <span class="info-box-number">114,381</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Direct Messages</span>
              <span class="info-box-number">163,921</span>

              <div class="progress">
                <div class="progress-bar" style="width: 40%"></div>
              </div>
              <span class="progress-description">
                    40% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
            
		</div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script>

	new Chart(document.getElementById("line-chart"), {
		  type: 'line',
		  data: {
		    labels: [2009,2010,2011,2012,2013,2014,2015,2016,2017,2018],
		    datasets: [{ 
		        data: [600,6140,5060,7060,6070,6111,6133,5221,7783,8478],
		        label: "EPAD",
		        borderColor: "#f56954",
		        fill: false
		      }, { 
		        data: [282,800,1411,1502,1635,2809,3947,3402,4700,5267],
		        label: "AMYPAD",
		        borderColor: "#00a65a",
		        fill: false
		      }, { 
		        data: [168,1170,2178,1190,2203,3276,4408,4547,5675,6734],
		        label: "MOPEAD",
		        borderColor: "#f39c12",
		        fill: false
		      }, { 
		        data: [400,200,100,1600,2400,3800,5400,6670,5080,7840],
		        label: "ROADMAP",
		        borderColor: "#00c0ef",
		        fill: false
		      }, { 
		        data: [600,300,200,200,700,2600,3200,4200,3120,4330],
		        label: "GEHRIG",
		        borderColor: "#3c8dbc",
		        fill: false
		      }
		    ]
		  },
		  options: {
		    title: {
		      display: false,
		      text: 'World population per region (in millions)'
		    }
		  }
		});

	</script>
	
@endsection

