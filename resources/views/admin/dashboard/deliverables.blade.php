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
