<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Add New Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-plus fa-xs mr-1"></i><i class="fas fa-angle-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="text-bold small px-3 py-1 dropdown-item-title">Add New</div>
                <div class="dropdown-divider"></div>
                <a href="{{ url('webtolead/create') }}" class="dropdown-item">
                    Web to Lead
                </a>
                <a href="{{ url('accounts/create') }}" class="dropdown-item">
                    Account
                </a>
                <a href="{{ url('contacts/create') }}" class="dropdown-item">
                    Contact
                </a>
                <a href="{{ url('leads/create') }}" class="dropdown-item">
                    Lead
                </a>
                <a href="{{ url('deals/create') }}" class="dropdown-item">
                    Deal
                </a>
                <a href="{{ url('territory/create') }}" class="dropdown-item">
                    Territory
                </a>
                <a href="{{ url('forecast/create') }}" class="dropdown-item">
                    Forecast
                </a>

                <a href="{{ url('products/create') }}" class="dropdown-item">
                    Product
                </a>
                <a href="{{ url('invoice/create') }}" class="dropdown-item">
                    Invoice
                </a>
                @can('isUser')
                    <a href="{{ url('/subusers') }}" class="dropdown-item">
                        SubUser
                    </a>
                @endcan
            </div>
        </li>
        <!-- profile Dropdown Menu -->
        <x-cms::layouts.profile />
    </ul>
</nav>
<!-- /.navbar -->
