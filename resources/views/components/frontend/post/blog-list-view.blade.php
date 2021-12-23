@props(['post'])

    <div class="col-12 col-sm-8 col-md-6 col-lg-12">
        <div class="media mb-5">
            <div class="list-media mobile-none">
                @if($post->getFirstMedia(Neeraj1005\Cms\Models\Post::MEDIA_COLLECTION_NAME))
                    {{ optional($post)->getFirstMedia(Neeraj1005\Cms\Models\Post::MEDIA_COLLECTION_NAME)->img('', ['alt' => $post->post_title]) }}
                @else

                    <img class="mr-3" src="{{ $post->fake_image ?? '' }}"
                        alt="{{ $post->slug ?? '' }}" />
                @endif
            </div>
            <div class="media-body">
                <h5 class="mt-0 mb-2 p-0">
                    <a href="{{ route('home.cms.show', $post->slug) }}" class="text-reset">
                        {{ $post->stringLimit($post->title, 100) ?? '' }}
                    </a>
                </h5>
                <div class="card-text p-0 m-0">{!! $post->summary_of_body ?? '' !!}</div>
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


            </div>
        </div>
    </div>
