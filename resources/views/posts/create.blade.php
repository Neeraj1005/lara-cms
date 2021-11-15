<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ __('Create Post') }}</h1>
        </x-slot>
        
        <div class="card">
            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <x-cms::label for="title" :value="__('Title')" />
                        <x-cms::input type="text" name="title" id="title"
                            value="{{ old('title') }}" />
                        <x-cms::auth-validation-errors :error="__('title')" />
                    </div>

                    <x-cms::button class="">{{ __('Submit') }}</x-cms::button>
                </form>
            </div>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
