              <div class="box box-purple">
                <div class="box-header with-border">
                  <h3 class="box-title">Key Areas for Projects</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                @foreach($contactscategories as $key=>$contactcategory)
                  <a href="/admin/contacts/category/{{ $contactcategory->id }}" class="btn btn-block btn-{{ $labels[$key] }}">
                    {{ $contactcategory->name }}
                  </a>
                @endforeach

                </div>
                <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="{{ route('admin.contacts.index') }}" class="uppercase">View All Key Areas for Projects</a>
                  </div>
                <!-- /.box-footer -->
              </div>
