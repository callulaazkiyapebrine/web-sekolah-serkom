<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'MAN 2 Tasikmalaya')
    </title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">

    <!-- BOOTSTRAP ICONS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- FONT -->
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS PUBLIC -->
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

    @stack('styles')

</head>

<body>

    {{-- NAVBAR --}}
    @include('public.layouts.navbar')

    {{-- ISI HALAMAN --}}
    @yield('content')

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>

    @stack('scripts')

</body>

</html>