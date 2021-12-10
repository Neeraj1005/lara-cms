<x-cms::layouts.home-layout>
    <div class="container">
        <div class="row">
            @forelse($posts as $post)
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <div class="card mb-4 card-custom">
                        <div class="card-img">
                            @if ($post->getFirstMedia(Neeraj1005\Cms\Models\Post::MEDIA_COLLECTION_NAME))
                                {{ optional($post)->getFirstMedia(Neeraj1005\Cms\Models\Post::MEDIA_COLLECTION_NAME) }}
                            @else
                                <img src="{{ $post->fake_image }}" alt="{{ $post->post_title }}">
                            @endif
                        </div>
                        <div class="card-img-overlay">
                            @if($post->user)
                                <div class="btn btn-light btn-sm">
                                    {{ $post->user ? $post->user->name : '' }}
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ route('home.cms.show', $post->slug) }}"
                                    class="text-reset">
                                    {{ $post->stringLimit($post->title, 44) ?? '' }}
                                </a>
                            </h4>
                            <small class="text-muted cat d-flex">
                                @if($post->cms_category_count > 0)
                                    <span class="d-flex align-items-center text-muted text-decoration-none mr-3">
                                        <i class="far fa-clock text-info"></i>
                                        {{ $post->cms_category->name ?? '' }}
                                    </span>
                                    <span class="d-flex align-items-center"
                                        title="{{ $post->created_at ?? '' }}">
                                        {{ $post->created_at->isoFormat('dddd DD, YYYY') ?? '' }}
                                    </span>
                                @endif
                            </small>
                            <p class="card-text">{!! $post->stringLimit($post->body, 77) ?? '' !!}</p>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
    {{-- @push('script')
@include('cms::includes.media-embed-ckeditor')
@endpush--}}
</x-cms::layouts.home-layout>
