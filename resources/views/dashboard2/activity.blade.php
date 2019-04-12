           <div class="box box-success">
            <div class="box-header ui-sortable-handle" style="cursor: move;">

              <h3 class="box-title">Activity</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            </div>
            
              <div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
              
                  <div class="item" v-for="activity in activities" :key="activity.id">
                    <img :src="activity.image" alt="user image" class="online">
    
                    <p class="message">
                      <a href="#" class="name">
                        <small class="text-muted pull-right" v-text="activity.date"><i class="fa fa-clock-o"></i></small>
                        <span v-text="activity.user"></span>
                      </a>
                      <span v-text="activity.body"></span>
                    </p>
                  </div>
                  <!-- /.item -->
                  <!-- chat item -->

            </div>
            

            <!-- /.chat -->
          <div class="box-footer text-center">
            <a href="{{ route('admin.posts.index') }}" class="uppercase">View All Activity</a>
          </div>
        <!-- /.box-footer -->
      </div>
      


      
      
      
      
      