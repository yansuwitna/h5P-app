<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Masuk - LMS H5P Interaktif') }}</title>

        <!-- Dark mode instant check -->
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- SweetAlert2 Library CDN & Custom Styling -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            .swal2-popup {
                border-radius: 1rem !important;
                font-family: 'Poppins', sans-serif !important;
                border: 1px solid #e2e8f0 !important;
            }
            .dark .swal2-popup {
                background-color: #0f172a !important;
                color: #f8fafc !important;
                border: 1px solid #334155 !important;
            }
            .dark .swal2-title { color: #f8fafc !important; }
            .dark .swal2-html-container { color: #94a3b8 !important; }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 dark:text-slate-100 antialiased bg-slate-50 dark:bg-[#090d16] bg-grid-pattern selection:bg-indigo-500 selection:text-white transition-colors duration-200 min-h-screen flex flex-col justify-between">
        
        {{ $slot }}

        <!-- SweetAlert2 Alert Login Failures -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if($errors->has('login') || $errors->has('email') || $errors->has('password'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Masuk',
                        text: "{{ $errors->first('login') ?: ($errors->first('email') ?: $errors->first('password')) }}",
                        confirmButtonText: 'Coba Lagi',
                        confirmButtonColor: '#4f46e5',
                        customClass: {
                            popup: 'rounded-2xl shadow-xl',
                            confirmButton: 'px-5 py-2.5 rounded-lg font-semibold text-xs'
                        }
                    });
                @endif
            });
        </script>
    </body>
</html>
