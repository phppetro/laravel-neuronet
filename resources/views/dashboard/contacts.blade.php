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