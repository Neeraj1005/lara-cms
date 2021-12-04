@php
    $siteLogo = Neeraj1005\Cms\Models\CmsSeo::first();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('posts.index') }}" class="brand-link">
        @if($siteLogo && $siteLogo->logo)
            {{ $siteLogo->getFirstMedia('seo_manager') }}
        @else
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        @endif
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3 pb-3 mb-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item 
                        {{ request()->routeIs('posts.*') ? 'menu-open' : '' }}
                        {{ request()->routeIs('report.*') ? 'menu-open' : '' }}
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
                                class="nav-link {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="font-size:15px;"></i>
                                <p>{{ __('Posts') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.categories.index') }}"
                                class="nav-link {{ request()->routeIs('posts.categories*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="font-size:15px;"></i>
                                <p>{{ __('Category') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.index') }}"
                                class="nav-link {{ request()->routeIs('report.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="font-size:15px;"></i>
                                <p>{{ __('Report') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cms.menus.index') }}"
                        class="nav-link {{ request()->routeIs('cms.menus*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon" style="font-size:15px;"></i>
                        <p>{{ __('Menu') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cms.media.index') }}"
                        class="nav-link {{ request()->routeIs('cms.media*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon" style="font-size:15px;"></i>
                        <p>{{ __('Media') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cms.settings') }}"
                        class="nav-link {{ request()->routeIs('cms.settings*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon" style="font-size:15px;"></i>
                        <p>{{ __('Settings') }}</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
