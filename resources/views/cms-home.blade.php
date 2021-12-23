<x-cms::layouts.home-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12 border-bottom mb-4 mobile-none">
                <div style="float:right;">
                    <strong>Display</strong>
                    <div class="btn-group">
                        <a href="{{ route('home.cms', ['q' => 'list']) }}"
                            id="list" class="btn btn-default btn-sm">
                            <x-cms::svg.list-grid-svg type="list" /> List</a>
                        <a href="{{ route('home.cms', ['q' => 'grid']) }}"
                            id="grid" class="btn btn-default btn-sm">
                            <x-cms::svg.list-grid-svg type="grid" /> Grid</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($posts as $post)
                @if(request('q') == 'grid')
                    <x-cms::frontend.post.blog-grid-view :post="$post" />
                @else
                    <x-cms::frontend.post.blog-list-view :post="$post" />
                @endif
            @empty
            @endforelse
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-cms::layouts.home-layout>
