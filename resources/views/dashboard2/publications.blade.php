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
                        
                            <div class="box-footer" v-for="publication in publications">
                              <div class="box-comment">
                                <div class="comment-text">
                                      <span class="username text-bold" v-text="publication.project"></span>
                                      <span class="text-muted pull-right" v-text="publication.year"></span><br>
                                  <a :href="publication.url" target="_blank" v-text="publication.title"></a>
                                </div>
                                <!-- /.comment-text -->
                              </div>
        
                              <!-- /.box-comment -->
                            </div>
                        
                    </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{ route('admin.publications.index') }}" class="uppercase">View All Publications</a>
                </div>
                <!-- /.box-footer -->
              </div>