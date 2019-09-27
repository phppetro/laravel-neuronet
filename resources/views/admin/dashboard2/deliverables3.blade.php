        	<div class="box box-aqua">
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
                        <th>Submission Date</th>
                        <th>Title</th>
                        <th>Project</th>
                      </tr>
                      </thead>
                      <tbody>

                        @foreach($deliverables as $deliverable)
                          <tr>
                            <td>{{ $deliverable->submission_date }}</td>
                            <td><a href="/admin/deliverables/{{ $deliverable->id }}">{{ $deliverable->title }}</a></td>
                            <td>{{ $deliverable->project->name }}</td>
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
