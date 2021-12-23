<footer class="bd-footer p-3 p-md-5 mt-5 text-center text-muted bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-left">
                {{-- <p class="copyright">
                    {{ date('Y') }}
                    <a href="{{ route('home.cms') }}">
                        {{ config('app.name') }}
                    </a>
                    {{ __('All rights reserved. ') }}
                    <a href="{{ route('sitemap') }}">{{ __('Sitemap') }}</a>
                </p> --}}
            </div>
            <div class="col-md-6 text-right">
                <div class="social-media-widget">
                    <a
                        href="{{ route('home.rss',['q' => 'latest-post']) }}" aria-label="latest post feed">
                        <x-cms::svg.rss-svg />
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
