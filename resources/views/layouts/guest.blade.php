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
    </head>
   <body style="background: #f0f3f7; font-family: 'Segoe UI', sans-serif;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="text-center mb-4">
                   
                     <x-application-logo class="w-25 m-auto" />

                    
                    <h3 class="mt-2 text-primary">School Management Portal</h3>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        {{ $slot }}
                    </div>
                </div>

                <p class="text-center text-muted mt-4" style="font-size: 13px;">
                    © {{ now()->year }} Your School Name. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
