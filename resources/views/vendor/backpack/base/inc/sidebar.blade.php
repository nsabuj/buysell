@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            {{--@if(Auth::user()):--}}
            {{--<img src="{{Auth::profile_pic->filename}}" class="img-circle" alt="User Image">--}}
            {{--@else--}}
            {{--<img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image">--}}
            {{--@endif--}}
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>


          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>

          <li><a href="{{ url(config('backpack.base.route_prefix_buyer', 'admin') . '/messages') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.messages') }}</span></a></li>
          <li><a href=""><i class="fa fa-language"></i> <span>{{ trans('backpack::crud.advertise') }}</span></a>
          <ul>
            <li><a href="{{ url(config('backpack.base.route_prefix', 'seller') . '/all_ads') }}"><i class="fa fa-language"></i> <span>All Advertisements</span></a></li>
            <li><a href="{{ url(config('backpack.base.route_prefix', 'seller') . '/create_ad') }}"><i class="fa fa-language"></i> <span>Add new</span></a></li>
          </ul>
          </li>
          <li><a href="{{ url(config('backpack.base.route_prefix_buyer', 'admin') . '/edit') }}"><i class="fa fa-language"></i> <span>{{ trans('backpack::crud.update_profile') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-language"></i> <span>{{ trans('backpack::crud.users') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-language"></i> <span>{{ trans('backpack::crud.roles') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/category') }}"><i class="fa fa-language"></i> <span>Categories</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/adminoption') }}"><i class="fa fa-language"></i> <span>Admin Options</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/language') }}"><i class="fa fa-flag-o"></i> <span>{{ trans('backpack::langfilemanager.languages') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/language/texts') }}"><i class="fa fa-language"></i> <span>{{ trans('backpack::langfilemanager.lang_files') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
