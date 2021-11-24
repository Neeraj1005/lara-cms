<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><svg xmlns="http://www.w3.org/2000/svg"
                    width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home.cms') }}"
                class="nav-link">{{ __('Visit Site') }}</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- profile Dropdown Menu -->
        <x-cms::layouts.profile />
    </ul>
</nav>
<!-- /.navbar -->
