<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(128, 0, 32, 0.1);
            box-shadow: 0 25px 50px rgba(128, 0, 32, 0.1);
        }

        .input-field {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(128, 0, 32, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #800020 0%, #A0002A 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(128, 0, 32, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #600018 0%, #800020 100%);
            transform: translateY(-3px);
            box-shadow: 0 25px 50px rgba(128, 0, 32, 0.4);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .social-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(248, 250, 252, 0.8);
            border: 1px solid rgba(128, 0, 32, 0.2);
        }

        .social-btn:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 15px 30px rgba(128, 0, 32, 0.15);
            border-color: rgba(128, 0, 32, 0.3);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-indigo-50 via-white to-cyan-50">
    <div class="min-h-screen flex">
        <!-- Left Panel - Content -->
        <div class="flex-1 flex items-center justify-center p-6 lg:p-12">
            <div class="w-full max-w-md">
                <!-- Logo Section -->
                <div class="flex items-center justify-center mb-6">
                    <img class="w-16 h-auto" src="{{ asset('img/logo-imm-ft-umj.png') }}" alt="Logo" aria-label="Logo">
                </div>

                <!-- Content Card -->
                <div class="glass-effect rounded-3xl p-8 slide-up">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
