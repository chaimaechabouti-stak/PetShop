<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Paws & Bowls - Animalerie en ligne</title>
    
    <!-- CSS Links -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Laravel Mix CSS -->
    @if(config('app.env') === 'production')
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endif
    
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
</head>
<body>
    <!-- Header -->
    @include('partials.header')
    
    <!-- Navigation -->
    @include('partials.navigation')
    
    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    <!-- JavaScript -->
    @if(config('app.env') === 'production')
        <script src="{{ mix('js/app.js') }}"></script>
    @else
        <script src="{{ asset('js/script.js') }}"></script>
    @endif
</body>
</html>