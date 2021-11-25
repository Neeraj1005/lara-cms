@php
    // $fontawesomePath = config('cms.asset_url')
    // ? config('cms.asset_url').'/laracms/css/cms_fontawesome.css'
    // : '/laracms/css/cms_fontawesome.css';

    $cssPath = config('cms.asset_url')
    ? config('cms.asset_url').'/laracms/css/cms_app.css'
    : '/laracms/css/cms_app.css';
@endphp

@if(config('cms.asset_url'))
    {{-- Fontawesome css using cdn--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
@else
    {{-- Fontawesome css not using cdn--}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/laracms/css/cms_fontawesome.css') }}" />
@endif

<link rel="stylesheet" type="text/css" href="{{ asset($cssPath) }}" />



<style>
    .ck-editor__editable {
        min-height: 150px !important;
        max-height: 400px !important;
    }

</style>



@stack('style')
