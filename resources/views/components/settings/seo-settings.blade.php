@props(['data'])
    <div>
        <form action="{{ route('cms.seo') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header text-primary font-weight-bold">{{ __('Seo Settings') }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <x-cms::label for="title" :value="__('Site Title')" />
                        <x-cms::input type="text" name="site_title" id="title"
                            value="{{ old('site_title', optional($data)->site_title) }}" />
                        <x-cms::auth-validation-errors :error="__('site_title')" />
                    </div>
                    <div class="form-group">
                        <x-cms::label for="description" :value="__('Site Description')" />
                        <x-cms::input type="text" name="site_description" id="description"
                            value="{{ old('site_description', optional($data)->site_description) }}" />
                        <x-cms::auth-validation-errors :error="__('site_description')" />
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between mb-1">
                            <div>
                                <x-cms::label for="logo" :value="__('logo')" />
                            </div>
                            <div class="">
                                @if($data && optional($data)->profile_img)
                                    <img src="{{ optional($data)->profile_img }}" alt="site_logo" srcset=""
                                        width="35px">
                                @endif
                            </div>
                        </div>
                        <x-cms::input type="file" name="picture" id="logo" />
                        <x-cms::auth-validation-errors :error="__('picture')" />
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        @if($data)
                            {{ __('Update') }}
                        @else
                            {{ __('Save') }}
                        @endif
                    </button>
                </div>
            </div>
        </form>
    </div>
