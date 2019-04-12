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