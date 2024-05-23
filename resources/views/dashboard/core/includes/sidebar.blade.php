<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('/') }}" class="brand-link">
        {{--        <img src="{{asset("logo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">@lang('dashboard.topBusiness')</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->image? asset(auth()->user()->image) :asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item  {{ in_array(request()->route()->getName(),['/'])? 'menu-open': '' }}">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.Home')
                        </p>
                    </a>
                </li>
                <li class="nav-item  {{ in_array(request()->route()->getName(),['users.index', 'users.create', 'users.edit', 'users.show'])? 'menu-open': '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.members')
                        </p>
                    </a>
                </li>

                <li class="nav-item  {{ in_array(request()->route()->getName(),['news.index', 'news.create', 'news.edit', 'news.show'])? 'menu-open': '' }}">
                    <a href="{{ route('news.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.news')
                        </p>
                    </a>
                </li>

                <li class="nav-item  {{ in_array(request()->route()->getName(),['settings.index', 'settings.create', 'settings.edit', 'settings.show'])? 'menu-open': '' }}">
                    <a href="{{ route('settings.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.settings')
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
