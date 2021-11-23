<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('cms.name', 'Lara-CMS') }}</title>
    <meta name="title" content="{{ $title ?? config('app.name') }}" />
    <meta name="description"
        content="{{ $description ?? config('cms.description') }}" />

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ $url ?? config('app.url') }}" />
    <meta name="twitter:title" content="{{ $title ?? config('app.name') }}" />
    <meta name="twitter:description"
        content="{{ $description ?? config('cms.description') }}" />
    <meta property="twitter:image"
        content="{{ $imageUrl ?? 'null' }}" />
    <meta name="twitter:site" content="{{ config('cms.twitter_site') }}" />
    <meta name="twitter:creator" content="{{ config('cms.twitter_profile') }}" />

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $url ?? config('app.url') }}" />
    <meta property="og:title" content="{{ $title ?? config('app.name') }}" />
    <meta property="og:description"
        content="{{ $description ?? config('cms.description') }}" />
    <meta property="og:image"
        content="{{ $imageUrl ?? 'null' }}" />


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    @include('cms::includes.style')
</head>

<body class="hold-transition">
    <main id="app">
        {{ $slot }}
    </main>
    @include('cms::includes.script')
</body>

</html>
