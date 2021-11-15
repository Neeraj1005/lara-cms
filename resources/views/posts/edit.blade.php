<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ __('Edit Post') }}</h1>
        </x-slot>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('posts.update', $post->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="enter title"
                            aria-describedby="title" value="{{ old('title', $post->title) }}">
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Update')  }}</button>
                </form>
            </div>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>