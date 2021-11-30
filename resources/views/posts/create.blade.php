<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ __('Create Post') }}</h1>
        </x-slot>
        <div class="card">
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                        <x-cms::button class="btn btn-sm btn-primary float-right mx-1" name="postType"
                            value="{{ Neeraj1005\Cms\Models\Post::TYPE_PUBLISHED }}">
                            {{ __('Publish') }}</x-cms::button>
                        <x-cms::button class="btn btn-sm btn-outline-secondary float-right mx-1" name="postType"
                            value="{{ Neeraj1005\Cms\Models\Post::TYPE_DRAFT }}">
                            {{ __('Draft') }}</x-cms::button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <x-cms::label for="title" :value="__('Title')" />
                                <x-cms::input type="text" name="title" id="title"
                                    value="{{ old('title') }}" />
                                <x-cms::auth-validation-errors :error="__('title')" />
                            </div>

                            <div class="form-group">
                                <x-cms::label for="description" :value="__('Description')" />
                                <textarea name="body" id="description" class="form-control" cols="30"
                                    rows="10">{{ old('description') }}</textarea>
                                <x-cms::auth-validation-errors :error="__('body')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <x-cms::label for="category" :value="__('Category')" />
                                <select class="form-control" name="category" id="category">
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <x-cms::auth-validation-errors :error="__('category')" />
                            </div>
                            <div class="form-group">
                                <x-cms::label for="picture" :value="__('Featured Image')" />
                                <x-cms::input type="file" name="picture" id="picture" aria-describedby="fileHelp" />
                                <small id="fileHelp" class="form-text text-muted">
                                    {{ __('Please upload a valid image file. Size of image should not be more than 2MB.') }}
                                </small>
                                <x-cms::auth-validation-errors :error="__('picture')" />
                            </div>

                            <div class="form-group">
                                <x-cms::label for="tags" :value="__('Tags')" />
                                <x-cms::input type="text" name="tags" id="tags" class="form-control"
                                    value="{{ old('tags') }}" />
                                <small id="tags" class="text-muted">
                                    {{ __('Separate tags with commas') }}
                                </small>
                                <x-cms::auth-validation-errors :error="__('tags')" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-cms::content-wrapper>
    @push('script')
        @include('cms::includes.ckeditor')
    @endpush
</x-cms::layouts.app>
