@php
    $cssPath = config('cms.asset_url')
    ? config('cms.asset_url').'/laracms/css/cms_app.css'
    : '/laracms/css/cms_app.css';
@endphp

<link rel="stylesheet" type="text/css" href="{{ asset($cssPath) }}" />

<style>
    .ck-editor__editable {
        min-height: 150px !important;
        max-height: 400px !important;
    }
</style>

@stack('style')
