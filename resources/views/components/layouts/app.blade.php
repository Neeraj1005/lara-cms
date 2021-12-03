<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $appTitle ?? config('cms.name', 'Lara-CMS') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    @include('cms::includes.style')
</head>

<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">

        <x-cms::layouts.navbar />

        <x-cms::layouts.aside />

        <main>
            {{ $slot }}
        </main>
    </div>
    @include('cms::includes.script')
</body>

</html>
