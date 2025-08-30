<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Careminate')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Example CSS -->
    <link rel="stylesheet" href="@asset('css/app.css')">
    <script src="@asset('js/app.js')"></script>
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
        </nav>
    </header>

    <main>
        @yield('main')
    </main>

    <footer>
        <p>&copy;<?php echo date('Y'); ?> Careminate. All rights reserved.</p>
    </footer>

    <!-- Stacks -->
    @stack('scripts')
</body>
</html>
