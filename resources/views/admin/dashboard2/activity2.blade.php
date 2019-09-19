           <div class="box box-pink">
            <div class="box-header ui-sortable-handle" style="cursor: move;">

              <h3 class="box-title">Activity</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            </div>
            <div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">

              @foreach($activities as $activity)

                <div class="item">
                  <img src="/thumb/{{ $activity->user ? $activity->user->photo : '' }}" alt="user image" class="purple">
                  <p class="message">
                    <a href="/admin/activities/{{ $activity->id }}" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ $activity->updated_at->diffForHumans() }}</small>
                      <span>
                        {{ $activity->user ? $activity->user->name . " " . $activity->user->surname . " - " . $activity->project->name : '' }}
                     </span>
                    </a>
                    <span>{{ str_limit($activity->message, 120) }}</span>
                  </p>
                </div>
                <!-- /.item -->

              @endforeach

          </div>

          <!-- /.chat -->
          <div class="box-footer text-center">
            <a href="{{ route('admin.activities.index') }}" class="uppercase">View All Activity</a>
          </div>
        <!-- /.box-footer -->
      </div>
