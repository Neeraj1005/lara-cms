<x-cms::layouts.home-layout>
    <x-slot name="title">
        {{ __('Blog Post') }}
    </x-slot>
    <x-slot name="description">
        {{ __('List of blogs') }}
    </x-slot>
    <x-slot name="url">
        {{ route('home.cms') }}
    </x-slot>
    <div class="container">
        <div class="posts-container mx-auto px-3 my-5">
            <div class="posts">
                @forelse($posts as $post)
                    <div class="post">
                        <h1 class="post-title fw-500">
                            <a href="{{ route('home.cms.show', $post->slug) }}">
                                {{ $post->stringLimit($post->title) ?? '' }}
                            </a>
                        </h1>
                        <div class="d-flex align-items-center mb-4 text-muted author-info">
                            
                            @if($post->cms_category_count > 0)
                                <span class="d-flex align-items-center text-muted text-decoration-none mr-3">
                                    {{ $post->cms_category->name ?? '' }}
                                </span>
                            @endif

                            <span class="d-flex align-items-center"
                                title="{{ $post->created_at ?? '' }}">
                                {{ $post->created_at->isoFormat('dddd DD, YYYY') ?? '' }}
                            </span>
                        </div>
                        @if($post->picture)
                            <div class="embed-responsive">
                                <img src="{{ asset($post->profileImage()) }}" />
                            </div>
                        @endif
                        <p>
                            {!! $post->stringLimit($post->body, 350) ?? '' !!}
                        </p>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</x-cms::layouts.home-layout>
