<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="/img/thumb/{{ Auth::user()->photo ? Auth::user()->photo : "place_holder.jpg" }}" class="user-image" alt="User Image">
    <span class="hidden-xs">{{ Auth::user()->name }}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="/img/thumb/{{ Auth::user()->photo ? Auth::user()->photo : "place_holder.jpg" }}" class="img-circle" alt="User Image">
      <p>
        {{ Auth::user()->name }}
        <small>Member since {{ Auth::user()->created_at->format('F Y') }}</small>
      </p>
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="/change_password" class="btn btn-default btn-flat">Change Password</a>
      </div>
      <div class="pull-right">
        <a href="#logout" onclick="$('#logout').submit();" class="btn btn-default btn-flat">@lang('global.app_logout')</a>
      </div>
    </li>
  </ul>
</li>
