<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'LMS H5P Interaktif') }}</title>

        <!-- Script Deteksi Dark Mode Instan -->
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- SweetAlert2 Library CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- H5P Standalone Player eksternal jika dibutuhkan -->
        <script src="https://cdn.jsdelivr.net/npm/h5p-standalone@3.8.2/dist/main.bundle.js"></script>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="antialiased text-slate-800 dark:text-slate-100 bg-[#f8fafc] dark:bg-[#0f172a] transition-colors duration-200 min-h-screen selection:bg-brand-500 selection:text-white font-sans overflow-x-hidden">
        @inertia
    </body>
</html>
