<x-cms::layouts.app>
    <x-cms::content-wrapper>
        <x-slot name="header">
            <h1>
                {{ __('Create Menus') }}
            </h1>
        </x-slot>

        <div class="row">
            <div class="col-md-7">
                <form method="post" action="{{ route('cms.menus.store') }}" enctype="multipart/form-data" class="needs-validation">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <x-cms::label for="name" :value="__('Name')" />
                                <x-cms::input type="text" name="name" id="name"
                                    value="{{ old('name') }}" />
                                <x-cms::auth-validation-errors :error="__('name')" />
                            </div>

                            <div class="form-group">
                                <x-cms::label for="url" :value="__('Url')" />
                                <x-cms::input type="text" name="url" id="url"
                                    value="{{ old('url') }}" />
                                <small class="text-muted">{{ __('for example https://laravel.com') }}</small>
                                <x-cms::auth-validation-errors :error="__('url')" />
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_checked" type="checkbox" id="is_checked">
                                    <x-cms::label for="is_checked" :value="__('Link open in new tab')" />
                                    <x-cms::auth-validation-errors :error="__('is_checked')" />
                                </div>
                            </div>
                        </div>
                        <!--card body end-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div> <!-- end card -->
                </form>
            </div>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
