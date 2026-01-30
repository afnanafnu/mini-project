<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/admin/app.css', 'resources/js/admin/app.js'])
</head>
<body>
    @include('partials.admin-header')

    <main>
        @yield('content')
    </main>

    @include('partials.admin-footer')
</body>
</html>
