<x-cms::layouts.app>
    <x-cms::content-wrapper>

        <x-slot name="header">
            <h1>
                {{ __('Settings') }}
            </h1>
        </x-slot>

        <div class="row">
            <div class="col-md-12">
                <div class="row">

                    {{-- left side div --}}
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="list-group customize-left" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="v-pills-home-seo"
                                        data-toggle="pill" href="#v-pills-seo" role="tab" aria-controls="v-pills-seo"
                                        aria-selected="true"><i class="fas fa-image"></i>
                                        SEO
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right side div --}}
                    <div class="col-9 pb-5">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-seo" role="tabpanel"
                                aria-labelledby="v-pills-home-seo">
                                <x-cms::settings.seo-settings :data="$seo" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-cms::content-wrapper>
</x-cms::layouts.app>
