<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'PropertyManage Pro Admin Dashboard' }}</title>

    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.14.1/css/jquery.dataTables.min.css">
    <!-- Optional: DataTables Bootstrap 5 styling -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.14.1/css/dataTables.bootstrap5.min.css">

    {{-- Global assets --}}
    @vite([
        'resources/css/Admin/layout/app.css',
        'resources/css/Admin/layout/header.css',
        'resources/css/Admin/layout/sidebar.css',
        'resources/css/Admin/layout/footer.css',
        'resources/js/Admin/layout/app.js',
        'resources/js/Admin/layout/sidebar.js'
    ])

    @stack('styles')
</head>

<body>

@include('admin.partials.header')

<div class="admin-container">
    @include('admin.partials.sidebar')

    <main class="admin-content">
        {{ $slot }}
    </main>
</div>

@include('admin.partials.footer')

<!-- Add jQuery and DataTables JS BEFORE your scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.14.1/js/jquery.dataTables.min.js"></script>

@stack('scripts')
</body>
</html>