<x-cms::layouts.home-layout>
    <x-slot name="title">
        {{ $post->title ?? '' }}
    </x-slot>
    <x-slot name="description">
        {{ $post->body ? $post->summary_of_body : '' }}
    </x-slot>
    <x-slot name="url">
        {{ route('home.cms.show', $post->slug) }}
    </x-slot>
    <x-slot name="imageUrl">
        {{ asset($post->profileImage()) }}
    </x-slot>
    <div class="container">
        <div class="posts-container px-3 mx-auto my-5">
            <div class="post">
                <h1 class="post-title fw-500">{{ $post->title ?? '' }}</h1>
                <div class="d-flex align-items-center mb-4 text-muted author-info">
                    <a class="d-flex align-items-center text-muted text-decoration-none" href="#" target="_blank"
                        rel="noopener">
                        <span>{{ $post->cms_category->name ?? '' }}</span>
                    </a>
                    <span class="d-flex align-items-center ml-3" title="{{ $post->created_at ?? '' }}">
                        {{ $post->created_at->isoFormat('dddd DD, YYYY') }}
                    </span>
                </div>
                @if($post->picture)
                    <div class="embed-responsive">
                        <img src="{{ asset($post->profileImage()) }}" />
                    </div>
                @endif
                <p>
                    {!! $post->body !!}
                </p>
            </div>
        </div>
    </div>
</x-cms::layouts.home-layout>
