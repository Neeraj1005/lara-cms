@php
    $menus = Neeraj1005\Cms\Models\CmsMenu::orderBy('order_column')->take(10)->get();
    $siteLogo = Neeraj1005\Cms\Models\CmsSeo::first();
@endphp
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="site_logo">
            @if($siteLogo && $siteLogo->logo)
                <img src="{{ $siteLogo->profile_img }}" width="30" height="30" class="d-inline-block align-top"
                    alt="">
            @else
                {{ config('app.name') }}
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                @forelse($menus as $menu)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ $menu->url }}"
                            {{ $menu->is_checked == 1 ? "target=_blank rel=noreferrer" : '' }}>{{ $menu->name }}</a>
                    </li>
                @empty
                @endforelse
            </ul>
        </div>
    </nav>
</header>
