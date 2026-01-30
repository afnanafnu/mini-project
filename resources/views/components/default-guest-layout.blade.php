<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PropertyManage Pro Guest Dashboard' }}</title>

    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- Global assets --}}
    @vite([
        'resources/css/Admin/layout/app.css',
        'resources/js/Admin/layout/app.js',
    ])

    {{-- Page styles --}}
    @stack('styles')
</head>

<body>

<main>
    {{ $slot }}
</main>

{{-- Page scripts --}}
@stack('scripts')

</body>
</html>
