<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Layout Default - Mazer Admin Dashboard</title>

    <!-- Meta Tags -->
    @stack('head')

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png" />
    <style>
        * {
            font-family: 'nunito', sans-serif;
        }
    </style>

    <!-- Additional CSS -->
    @stack('styles')
</head>

<body>
    <script src="{{ asset('assets/js/initTheme') }}.js"></script>
    <div id="app">
        <!-- Sidebar -->
        @include('layouts._sidebar')

        <!-- Main Content -->
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <!-- Header -->
                @include('layouts._header')
                <!-- Main Section -->
                <section class="section">
                    @yield('content')
                </section>
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>{{ date('Y') }} &copy; MyPOS</p>
                    </div>
                    <div class="float-end">
                        <p>
                            Crafted with
                            <span class="text-danger"><i class="bi bi-heart"></i></span> by
                            <a href="https://virgiawan.me">Virgiawan</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Pre Scripts -->
    @stack('footer')

    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
