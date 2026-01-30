<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PropertyManage Pro | Dashboard')</title>

    <!-- Vite CSS and JS -->
    @vite([
        'resources/css/web/layout/app.css', 
        'resources/js/web/layout/app.js'
    ])
</head>
<body>
    @include('web.partials.header')

    <main>
        @yield('content')
    </main>

    @include('web.partials.footer')
</body>
</html>
