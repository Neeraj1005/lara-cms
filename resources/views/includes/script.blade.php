@php
    $path = config('cms.asset_url') ? config('cms.asset_url').'/laracms/js/cms_bootstrap.js' : '/laracms/js/cms_bootstrap.js';
@endphp
<script type="text/javascript" src="{{ asset($path) }}"></script>
@stack('script')
