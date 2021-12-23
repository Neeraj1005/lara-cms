@props(['post'])
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card mb-4 card-custom">
            <div class="card-img">
                @if($post->getFirstMedia(Neeraj1005\Cms\Models\Post::MEDIA_COLLECTION_NAME))
                    {{ optional($post)->getFirstMedia(Neeraj1005\Cms\Models\Post::MEDIA_COLLECTION_NAME)->img('', ['alt'=> $post->post_title]) }}
                @else
                    <img src="{{ $post->fake_image ?? '' }}"
                        alt="{{ $post->slug ?? '' }}" />
                @endif
            </div>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('home.cms.show', $post->slug) }}" class="text-reset">
                        {{ $post->stringLimit($post->title, 35) ?? '' }}
                    </a>
                </h4>
                <div class="text-muted cat d-flex">
                    @if($post->cms_category_count > 0)
                        <span class="d-flex align-items-center text-muted text-decoration-none mr-3">
                            <a
                                href="{{ route('home.cms', ['category' => $post->cms_category->slug ?? '']) }}">
                                <x-cms::svg.clock-svg />
                                {{ $post->cms_category->name ?? '' }}
                            </a>
                        </span>
                        <span class="d-flex align-items-center"
                            title="{{ $post->created_at ?? '' }}">
                            {{ $post->created_at->isoFormat('dddd DD, YYYY') ?? '' }}
                        </span>
                    @endif
                </div>
                <div class="card-text">{!! $post->stringLimit($post->body, 77) ?? '' !!}</div>
            </div>
        </div>
    </div>
