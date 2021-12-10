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
    <div class="container" style="width:960px;margin:0 auto;">
        <div class="posts-container px-3 mx-auto my-5">
            <div class="post">
                <h1 class="post-title fw-500">{{ $post->title ?? '' }}</h1>
                <div class="d-flex align-items-center mb-4 text-muted author-info">
                    @if ($post->user)
                        <span class="d-flex align-items-center text-muted text-decoration-none mr-2">
                            <span>{{ $post->user ? $post->user->user_name : '' }}</span>
                        </span>
                    @endif

                    @if ($post->cms_category_count > 0)
                        <a class="d-flex align-items-center text-muted text-decoration-none mr-3"
                            href="{{ route('home.cms', ['category' => $post->cms_category->slug ?? '']) }}"
                            target="_blank" rel="noopener noreferrer">
                            <span>{{ $post->cms_category->name ?? '' }}</span>
                        </a>
                    @endif
                    <span class="d-flex align-items-center" title="{{ $post->created_at ?? '' }}">
                        {{ $post->created_at->isoFormat('dddd DD, YYYY') }}
                    </span>
                </div>
                @if ($post->getFirstMedia(Neeraj1005\Cms\Models\Post::MEDIA_COLLECTION_NAME))
                    <!--<div class="img-fluid">
                        {{ optional($post)->getFirstMedia(Neeraj1005\Cms\Models\Post::MEDIA_COLLECTION_NAME) }}
                    </div>-->
                @endif
                <p>
                    {!! $post->body !!}
                </p>
            </div>
            {{-- Start Tag list --}}
            @if ($post->cms_tags_count > 0)
                <div class="tags">
                    <p>
                        <span class="font-weight-bold">Tags:</span>
                        @forelse($post->cms_tags as $tag)
                            <a href="{{ route('home.cms', ['tag' => $tag->slug]) }}" target="_blank"
                                rel="noopener noreferrer">{{ $tag->name }}{{ $loop->last ? '' : ', ' }}</a>
                        @empty
                        @endforelse
                    </p>
                </div>
            @endif
            {{-- End Tag list --}}
        </div>
    </div>
    @push('script')
        @include('cms::includes.media-embed-ckeditor')
    @endpush
</x-cms::layouts.home-layout>
