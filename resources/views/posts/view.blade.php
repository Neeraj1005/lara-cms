<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ $post->title }}</h1>
        </x-slot>
        <div class="card">
            <div class="card-body">
                {{ $post->title }}
            </div>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
