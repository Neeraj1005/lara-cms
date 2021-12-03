<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>{{ __('Add Media') }}</h1>
        </x-slot>
        <div class="card">
            <form action="{{ route('cms.media.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-header row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                        <x-cms::button class="btn btn-sm btn-primary float-right mx-1" name="postType" value="save">
                            {{ __('Save') }}</x-cms::button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <x-cms::label for="media" :value="__('File')" />
                                <x-cms::input type="file" name="media" id="media" />
                                <x-cms::auth-validation-errors :error="__('media')" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
