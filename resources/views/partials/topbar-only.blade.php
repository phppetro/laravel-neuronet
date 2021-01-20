<header class="main-header">
    <nav class="navbar navbar-static-top">

      <div class="navbar-header">
        <a href="{{ url('/home/') }}" class="navbar-brand neuronet-logo"><img class="neuronet-logo-lg" src="/img/Neuronet_Logo.png"></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <div class="navbar-collapse pull-left collapse" id="navbar-collapse" aria-expanded="false" style="height: 1px;">
        <ul class="nav navbar-nav">
          <li class="dropdown">
              <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Dashboard <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="/admin">Dashboard</a></li>
                    <li><a href="{{ route('admin.asset_maps.diagram') }}">Asset Map</a></li>
                    <li><a href="{{ route('admin.decision_tools.diagram') }}">@lang('global.decision-tool.title')</a></li>
{{--                  <li class="divider"></li>--}}
                  <li><a href="{{url('admin/calendar')}}">Calendar</a></li>
              </ul>
          </li>

          <li class="dropdown">
              <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Knowledge Base details <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
{{--                  @can('project_access')--}}
                      <li><a href="{{ route('admin.projects.index') }}">@lang('global.projects.title')</a></li>
{{--                  @endcan--}}
{{--                  @can('asset_map_access')--}}
                      <li><a href="{{ route('admin.asset_maps.index') }}">@lang('global.asset-map.title')</a></li>
{{--                  @endcan--}}
{{--                  @can('partner_access')--}}
                      <li><a href="{{ route('admin.partners.index') }}">@lang('global.partners.title')</a></li>
{{--                  @endcan--}}
{{--                  @can('work_package_access')--}}
                      <li><a href="{{ route('admin.work_packages.index') }}">@lang('global.work-packages.title')</a></li>
{{--                  @endcan--}}
{{--                  @can('deliverable_access')--}}
                      <li><a href="{{ route('admin.deliverables.index') }}">@lang('global.deliverables.title')</a></li>
{{--                  @endcan--}}
{{--                  @can('publication_access')--}}
                    <li><a href="{{ route('admin.publications.index') }}">@lang('global.publications.title')</a></li>
{{--                  @endcan--}}
{{--                  @can('document_access')--}}
                      <li><a href="{{ route('admin.documents.index') }}">@lang('global.documents.title')</a></li>
{{--                  @endcan--}}
{{--                  @can('tool_access')--}}
                      <li><a href="{{ route('admin.tools.index') }}">@lang('global.tools.title')</a></li>
{{--                  @endcan--}}
{{--                  @can('calendar_access')--}}
                      <li><a href="{{ route('admin.calendars.index') }}">@lang('global.calendar.title')</a></li>
{{--                  @endcan--}}
{{--                      @can('activity_access')--}}
{{--                        <li><a href="{{ route('admin.activities.index') }}">@lang('global.activity.title')</a></li>--}}
{{--                      @endcan--}}
{{--                      @can('contact_access')--}}
{{--                        <li><a href="{{ route('admin.contacts.index') }}">@lang('global.contacts.title')</a></li>--}}
{{--                      @endcan--}}
{{--                      @can('contact_category_access')--}}
{{--                        <li><a href="{{ route('admin.contact_categories.index') }}">@lang('global.contact-categories.title')</a></li>--}}
{{--                      @endcan--}}
              </ul>
          </li>

{{--          @can('faq_management_access')--}}
{{--              <li class="dropdown">--}}
{{--                  <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">@lang('global.faq-management.title')<span class="caret"></span></a>--}}
{{--                  <ul class="dropdown-menu" role="menu">--}}
{{--                      @can('faq_category_access')--}}
{{--                        <li><a href="{{ route('admin.faq_categories.index') }}">@lang('global.faq-categories.menu-title')</a></li>--}}
{{--                      @endcan--}}
{{--                      @can('faq_question_access')--}}
{{--                        <li><a href="{{ route('admin.faq_questions.index') }}">@lang('global.faq-questions.menu-title')</a></li>--}}
{{--                      @endcan--}}
{{--                  </ul>--}}
{{--              </li>--}}
{{--          @endcan--}}
{{--          @can('content_management_access')--}}
{{--              <li class="dropdown">--}}
{{--                  <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">@lang('global.content-management.title')<span class="caret"></span></a>--}}
{{--                  <ul class="dropdown-menu" role="menu">--}}
{{--                      @can('content_category_access')--}}
{{--                        <li><a href="{{ route('admin.content_categories.index') }}">@lang('global.content-categories.menu-title')</a></li>--}}
{{--                      @endcan--}}
{{--                      @can('content_tag_access')--}}
{{--                        <li><a href="{{ route('admin.content_tags.index') }}">@lang('global.content-tags.menu-title')</a></li>--}}
{{--                      @endcan--}}
{{--                      @can('content_page_access')--}}
{{--                        <li><a href="{{ route('admin.content_pages.index') }}">@lang('global.content-pages.menu-title')</a></li>--}}
{{--                      @endcan--}}
{{--                  </ul>--}}
{{--              </li>--}}
{{--          @endcan--}}

            @auth
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">@lang('global.system-management.title')<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @auth
                            @can('highlights_metric_access')
                                <li><a href="{{ route('admin.highlights_metrics.index') }}">@lang('global.highlights-metrics.title')</a></li>
                            @endcan
                            @can('partners_metric_access')
                                <li><a href="{{ route('admin.partners_metrics.index') }}">@lang('global.partners-metrics.title')</a></li>
                            @endcan
                            @can('projects_metric_access')
                                <li><a href="{{ route('admin.projects_metrics.index') }}">@lang('global.projects-metrics.title')</a></li>
                            @endcan
                            @can('countries_metric_access')
                                <li><a href="{{ route('admin.countries_metrics.index') }}">@lang('global.countries-metrics.title')</a></li>
                            @endcan
                            @can('decision_tool_access')
                                <li><a href="{{ route('admin.decision_tools.index') }}">@lang('global.decision-tool.title')</a></li>
                            @endcan
                        @endauth
                        @can('system_management_access')
                            @can('wp_access')
                                <li><a href="{{ route('admin.wps.index') }}">@lang('global.wp.title')</a></li>
                            @endcan
                            @can('color_access')
                                <li><a href="{{ route('admin.colors.index') }}">@lang('global.color.title')</a></li>
                            @endcan
                            @can('type_of_institution_access')
                                <li><a href="{{ route('admin.type_of_institutions.index') }}">@lang('global.type-of-institution.title')</a></li>
                            @endcan
                        @endcan
                        @can('content_management_access')
                            @can('content_category_access')
                                <li><a href="{{ route('admin.content_categories.index') }}">@lang('global.content-categories.menu-title')</a></li>
                            @endcan
                            @can('content_tag_access')
                                <li><a href="{{ route('admin.content_tags.index') }}">@lang('global.content-tags.menu-title')</a></li>
                            @endcan
                            @can('content_page_access')
                                <li><a href="{{ route('admin.content_pages.index') }}">@lang('global.content-pages.menu-title')</a></li>
                            @endcan
                        @endcan
                            @can('faq_management_access')
                                @can('faq_category_access')
                                    <li><a href="{{ route('admin.faq_categories.index') }}">@lang('global.faq-categories.menu-title')</a></li>
                                @endcan
                                @can('faq_question_access')
                                    <li><a href="{{ route('admin.faq_questions.index') }}">@lang('global.faq-questions.menu-title')</a></li>
                                @endcan
                        @endcan
                    </ul>
                </li>
            @endauth
          @can('user_management_access')
              <li class="dropdown">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">@lang('global.user-management.title')<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                      @can('user_access')
                        <li><a href="{{ route('admin.users.index') }}">@lang('global.users.title')</a></li>
                      @endcan
                      @can('role_access')
                        <li><a href="{{ route('admin.roles.index') }}">@lang('global.roles.title')</a></li>
                      @endcan
                      @can('permission_access')
                        <li><a href="{{ route('admin.permissions.index') }}">@lang('global.permissions.title')</a></li>
                      @endcan
                      @can('professional_category_access')
                        <li><a href="{{ route('admin.professional_categories.index') }}">@lang('global.professional-category.title')</a></li>
                      @endcan
                      @can('education_access')
                        <li><a href="{{ route('admin.education.index') }}">@lang('global.education.title')</a></li>
                      @endcan
                      @can('country_access')
                        <li><a href="{{ route('admin.countries.index') }}">@lang('global.country.menu-title')</a></li>
                      @endcan
                      @can('user_action_access')
                        <li><a href="{{ route('admin.user_actions.index') }}">@lang('global.user-actions.title')</a></li>
                      @endcan
                  </ul>
              </li>
          @endcan
        </ul>
      </div>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}"> Login </a>
                  </li>
              @endguest

            @if(Auth::user())
              @include('partials.user-menu')
            @endif

          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
    </nav>
  </header>


<style>
    .slimScrollDiv {
        width: auto !important;
        height:auto !important;
    }

    .language-menu {
        width: auto !important;
        list-style-type: none;
        padding: 0;
        margin: 0;
        max-width: 300px;
        height:auto !important;
        max-height: 500px !important;
    }

    .language-link {
        width: auto;
    }

    .language-link a {
        display: block;
        width: 100%;
        white-space: normal !important;
        padding: 5px;
    }
    .language-link a:hover {
        color: #389ad2;
        background: #f9f9f9;
    }
</style>
