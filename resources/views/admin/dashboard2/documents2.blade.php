               <div class="box box-violet">
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
                 <div class="table-responsive">
                   <table class="table no-margin">
                     <thead>
                     <tr>
                       <th>Publication Date</th>
                       <th>Title</th>
                       <th>Source</th>
                     </tr>
                     </thead>
                     <tbody>

                      @foreach($documents as $document)
                        <tr>
                          <td>{{ $document->publication_date }}</td>
                          <td><a href="/admin/documents/{{ $document->id }}">{{ $document->title }}</a></td>
                          <td>{{ $document->source }}</td>
                        </tr>
                      @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{ route('admin.documents.index') }}" class="uppercase">View All Documents</a>
                </div>
                <!-- /.box-footer -->
              </div>
