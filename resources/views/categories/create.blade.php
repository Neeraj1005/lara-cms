<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ __('Create Category') }}</h1>
        </x-slot>
        <div class="card">
            <form action="{{ route('posts.categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                        <x-cms::button class="btn btn-sm btn-outline-primary float-right mx-1" name="postType"
                            value="save">{{ __('Save') }}</x-cms::button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <x-cms::label for="name" :value="__('Name')" />
                                <x-cms::input type="text" name="name" id="name"
                                    value="{{ old('name') }}" />
                                <x-cms::auth-validation-errors :error="__('name')" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
