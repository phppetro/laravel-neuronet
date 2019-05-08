<div class="box box-purple">
  <div class="box-header with-border">
    <h3 class="box-title">Future Events</h3>

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
          <th>Date</th>
          <th>Event</th>
          <th>Project</th>
          <th>Location</th>
        </tr>
        </thead>
        <tbody>

          @foreach($events as $event)
            <tr>
              <td>{{ $event->date }}</td>
              <td><a href="/admin/calendars/{{ $event->id }}">{{ $event->title }}</a></td>
              <td>{{ $event->project->name }}</td>
              <td>{{ $event->location }}</td>
            </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.box-body -->
  <div class="box-footer text-center">
    <a href="{{ url('admin/calendar') }}" class="uppercase">View Calendar</a>
  </div>
  <!-- /.box-footer -->
</div>
