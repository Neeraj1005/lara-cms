@php
    $seo = Neeraj1005\Cms\Models\CmsSeo::first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? (optional($seo)->meta_title ?? config('cms.name')) }}
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;70

    <meta name=" title"
        content="{{ $title ?? (optional($seo)->meta_title ?? config('cms.name')) }}" />
    <meta name="description"
        content="{{ $description ?? (optional($seo)->meta_description ?? config('cms.description')) }}" />

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ $url ?? route('home.cms') }}" />
    <meta name="twitter:title"
        content="{{ $title ?? (optional($seo)->meta_title ?? config('cms.name')) }}" />
    <meta name="twitter:description"
        content="{{ $description ?? (optional($seo)->meta_description ?? config('cms.description')) }}" />
    <meta property="twitter:image" content="{{ $imageUrl ?? optional($seo)->profile_img }}" />

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $url ?? route('home.cms') }}" />
    <meta property="og:title"
        content="{{ $title ?? (optional($seo)->meta_title ?? config('cms.name')) }}" />
    <meta property="og:description"
        content="{{ $description ?? (optional($seo)->meta_description ?? config('cms.description')) }}" />
    <meta property="og:image" content="{{ $imageUrl ?? optional($seo)->profile_img }}" />

    @include('cms::includes.style')
</head>

<body class="hold-transition">

    <x-cms::layouts.home-header />

    <main id="app">
        {{ $slot }}
    </main>

    <x-cms::layouts.footer />
    @include('cms::includes.script')
</body>

</html>
