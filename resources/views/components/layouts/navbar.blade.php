<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home.cms') }}"
                class="nav-link" target="_blank" rel="noopener noreferrer">{{ __('Visit Site') }}</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- profile Dropdown Menu -->
        <x-cms::layouts.profile />
    </ul>
</nav>
<!-- /.navbar -->
