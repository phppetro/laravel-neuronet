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