<x-cms::layouts.home-layout>
    <x-slot name="title">
        {{ __('sitemap') }}
    </x-slot>
    <x-slot name="description">
        {{ __('Latest Post sitemap') }}
    </x-slot>
    <x-slot name="url">
        {{ route('sitemap') }}
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mt-5 mb-4">{{ __('Sitemap') }}</h3>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend>
                                <div class="row">
                                    <div class="col">
                                        <h3>{{ __('Post') }}</h3>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('home.rss') }}" class="badge badge-primary">{{ __('RSS') }}</a>
                                    </div>
                                </div>
                            </legend>

                            @foreach($categoriesHasPost as $category)
                                <div class="media">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="m-0">
                                                    {{ $category->name }}
                                                    [{{ $category->cms_posts->count() ?? '' }}]
                                                </h5>
                                            </div>
                                        </div>

                                        @foreach($category->cms_latest_posts as $post)
                                            <div class="media">
                                                <div class="media-body">
                                                    <a class=""
                                                        href="{{ route('home.cms.show', $post->slug) }}">
                                                        <li class="p-2">
                                                            {{ $post->title }}
                                                        </li>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {!! $loop->last ? '' : '
                                <hr>' !!}
                            @endforeach
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cms::layouts.home-layout>
