<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home.cms') }}" class="brand-link">
        <img alt="{{ config('app.name') }}" height="60" width="60" class="img-circle"
            src="{{ 'https://ui-avatars.com/api/?background=random&name='.config('app.name') }}" />
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3 pb-3 mb-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item 
                        {{ request()->is('cms/posts*') ? 'menu-open' : '' }}
                        {{ request()->is('cms/categories*') ? 'menu-open' : '' }}
                        ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-phone"></i>
                        <p>
                            {{ __('CMS') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}"
                                class="nav-link {{ Request::is('cms/posts*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="font-size:15px;"></i>
                                <p>{{ __('Posts') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.categories.index') }}"
                                class="nav-link {{ Request::is('cms/categories*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="font-size:15px;"></i>
                                <p>{{ __('Category') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
