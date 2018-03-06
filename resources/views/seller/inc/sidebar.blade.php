@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::crud.seller') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>--}}


          {{--<!-- ======================================= -->--}}
          <li><a href="{{ url(config('backpack.base.route_prefix_buyer', 'seller') . '/edit') }}"><i class="fa fa-language"></i> <span>{{ trans('backpack::crud.update_profile') }}</span></a></li>


          <li><a href=""><i class="fa fa-language"></i> <span>{{ trans('backpack::crud.advertise') }}</span></a>
          <ul>
            <li><a href="{{ url(config('backpack.base.route_prefix_seller', 'seller') . '/my_ads') }}"><i class="fa fa-language"></i> <span>My Advertisements</span></a></li>
            <li><a href="{{ url(config('backpack.base.route_prefix_seller', 'seller') . '/create_ad') }}"><i class="fa fa-language"></i> <span>Add new</span></a></li>
          </ul>
          </li>

          <li><a href="{{ url(config('backpack.base.route_prefix_buyer', 'seller') . '/messages') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.messages') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix_buyer', 'seller') . '/notifications') }}"><i class="fa fa-flag-o"></i> <span>{{ trans('backpack::crud.notifications') }}</span></a></li>
          {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/language/texts') }}"><i class="fa fa-language"></i> <span>{{ trans('backpack::langfilemanager.lang_files') }}</span></a></li>--}}

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
