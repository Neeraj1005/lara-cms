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

    .brand-link {
        padding: 0.5125rem 0.5rem;
    }

    a.brand-link img {
        width: 150px;
        height: 36px;
        object-fit: contain;
        background: #fff;
        border-radius: 3px;
        padding: 5px;
    }

</style>

@stack('style')
