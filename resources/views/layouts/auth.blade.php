<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ isset($title) ? $title . ' - MyPOS' : 'MyPOS' }}</title>

    <!-- Meta Tags -->
    @stack('head')

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png" />

    <style>
        * {
            font-family: 'nunito', 'open-sans', sans-serif;
        }
    </style>

    <!-- Additional CSS -->
    @stack('styles')
</head>

<body>
    <div id="auth">
        @yield('content')
    </div>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
