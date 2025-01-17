<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    <!-- Link CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> <!-- Custom CSS -->
</head>
<body class="bg-white">
    <!-- Page Content -->
    <main class="py-4">
        @yield('content')
         <!-- Logo image -->
    </main>
    <!-- Footer -->
    <footer class="bg-dark text-white py-3 text-center">
        <p>&copy; 2024 Klinik Sehat. All Rights Reserved.</p>
    </footer>
</body>

</html>