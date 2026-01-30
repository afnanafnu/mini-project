<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mini Project | Dashboard' }}</title>

    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- Global assets --}}
    @vite([
        'resources/css/web/layout/app.css',
        'resources/css/web/layout/header.css',
        'resources/css/web/layout/footer.css',
        'resources/js/web/layout/app.js',
        'resources/js/web/layout/header.js',
        'resources/js/web/layout/footer.js'
    ])

    {{-- Page styles --}}
    @stack('styles')
</head>

<body>

@include('web.partials.header')

<main>
    {{ $slot }}
</main>

@include('web.partials.footer')

{{-- Page scripts --}}
@stack('scripts')

</body>
</html>
