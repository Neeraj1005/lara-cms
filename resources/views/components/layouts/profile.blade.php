@php
    $profileName = "https://ui-avatars.com/api/?background=random&name=".auth()->user()->name;
@endphp
<li class="nav-item dropdown">
    <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <img class="img-profile rounded-circle" alt="{{ config('app.name') }}" width="24" height="24"
            src="{{ $profileName }}" />
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"
        style="width:275px;-webkit-box-shadow: 0 2px 10px rgba(0,0,0,.2)!important;">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <img src="{{ $profileName }}" class="user-image2 rounded-circle my-2"
                        alt="{{ auth()->user()->name }}" width="85" height="85">
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <h6 class="m-0"><span class="hidden-xs">{{ Auth::user()->name }}</span></h6>
                <div class="text-muted small">{{ Auth::user()->email }}</div>
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-link btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>
