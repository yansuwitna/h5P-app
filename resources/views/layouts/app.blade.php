<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LMS H5P Interaktif') }}</title>

        <!-- Script Deteksi Dark Mode Instan (TailAdmin Pattern) -->
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- SweetAlert2 Library CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            .swal2-popup {
                border-radius: 1rem !important;
                font-family: 'Poppins', sans-serif !important;
                border: 1px solid #e2e8f0 !important;
            }
            .dark .swal2-popup {
                background-color: #1e293b !important;
                color: #f8fafc !important;
                border: 1px solid #334155 !important;
            }
            .dark .swal2-title { color: #f8fafc !important; }
            .dark .swal2-html-container { color: #94a3b8 !important; }
        </style>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-data="{ sidebarOpen: false, sidebarExpanded: true }" class="antialiased text-slate-800 dark:text-slate-100 bg-[#f8fafc] dark:bg-[#0f172a] transition-colors duration-200 min-h-screen flex selection:bg-brand-500 selection:text-white font-sans overflow-x-hidden">

        @php
            $userRole = session('role', Auth::user()->role ?? 'student');
            $roleBadge = $userRole === 'admin' ? 'Administrator' : ($userRole === 'teacher' ? 'Tenaga Pendidik' : 'Siswa Aktif');
            $roleColor = $userRole === 'admin' ? 'text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/50 border-rose-200 dark:border-rose-900/60' : ($userRole === 'teacher' ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/50 border-indigo-200 dark:border-indigo-900/60' : 'text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 border-emerald-200 dark:border-emerald-900/60');
            $roleDot = $userRole === 'admin' ? 'bg-rose-500' : ($userRole === 'teacher' ? 'bg-indigo-500' : 'bg-emerald-500');
        @endphp

        <!-- Backdrop Mobile Sidebar -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden" 
             style="display: none;"></div>

        <!-- ============================================== -->
        <!-- TAILADMIN PERSISTENT DARK/LIGHT SIDEBAR (LEFT) -->
        <!-- ============================================== -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed top-0 left-0 z-50 flex h-screen w-64 flex-col overflow-y-hidden bg-[#1c2434] text-slate-300 duration-300 ease-linear dark:bg-[#1c2434] border-r border-[#2e3a4b] shrink-0">
            
            <!-- Sidebar Header / Brand Logo -->
            <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6 border-b border-[#2e3a4b]">
                <a href="{{ route('beranda') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-brand-600 flex items-center justify-center text-white shadow-md shadow-brand-600/30 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-lg font-bold tracking-tight text-white">Tail<span class="text-brand-500">LMS</span></span>
                            <span class="text-[10px] px-1.5 py-0.2 rounded bg-brand-600/30 text-brand-300 font-semibold border border-brand-500/30">v2.0</span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-medium tracking-wide uppercase">H5P Interactive Suite</p>
                    </div>
                </a>

                <!-- Mobile Close Button -->
                <button @click="sidebarOpen = false" class="block lg:hidden text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar User Mini Badge Card (TailAdmin Style) -->
            <div class="px-5 py-4 mx-4 my-4 rounded-xl bg-[#243044] border border-[#2e3a4b] flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-tr from-brand-600 to-indigo-500 flex items-center justify-center font-bold text-sm text-white shadow-sm shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden min-w-0">
                    <h4 class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</h4>
                    <span class="inline-flex items-center gap-1 text-[10px] font-medium text-slate-400 truncate">
                        <span class="w-1.5 h-1.5 rounded-full {{ $roleDot }}"></span>
                        {{ $roleBadge }}
                    </span>
                </div>
            </div>

            <!-- Sidebar Navigation Links Area -->
            <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear px-4 py-2 flex-1 space-y-6">
                
                <div>
                    <h3 class="mb-2.5 px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Menu Utama
                    </h3>

                    <ul class="space-y-1.5 text-xs font-medium">
                        @if($userRole === 'admin')
                            <!-- ADMIN MENU -->
                            <li>
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                                    <span>Dashboard Utama</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.guru') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('admin.guru') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg>
                                    <span>Data Guru</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.siswa') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('admin.siswa') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-7.5 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                                    <span>Data Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.cms') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('admin.cms') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                    <span>CMS Landing Page</span>
                                </a>
                            </li>

                        @elseif($userRole === 'teacher')
                            <!-- TEACHER MENU -->
                            <li>
                                <a href="{{ route('guru.dashboard') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('guru.dashboard') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                                    <span>Dashboard Pendidik</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('guru.siswa') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('guru.siswa') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-7.5 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                                    <span>Siswa Kelas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('guru.materi') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('guru.materi') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" /></svg>
                                    <span>Modul Pembelajaran</span>
                                </a>
                            </li>

                        @else
                            <!-- STUDENT MENU -->
                            <li>
                                <a href="{{ route('siswa.dashboard') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('siswa.dashboard') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                                    <span>Ruang Belajar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('siswa.materi') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('siswa.materi') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg>
                                    <span>Katalog Materi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('siswa.rapor') }}" 
                                   class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('siswa.rapor') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.003 0H9.497m5.003 0a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H9.497a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                    <span>Rapor & Lencana</span>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('profile.edit') }}" 
                               class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200 {{ request()->routeIs('profile.*') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : '' }}">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <span>Pengaturan Profil</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Akses Cepat / External Link (TailAdmin Card Style) -->
                <div class="pt-4 border-t border-[#2e3a4b]">
                    <h3 class="mb-2.5 px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Pintasan
                    </h3>
                    <a href="/" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#243044] border border-[#2e3a4b] text-xs font-semibold text-brand-400 hover:border-brand-500 transition duration-200">
                        <span class="flex items-center gap-2">
                            <span>🌐</span>
                            <span>Landing Page</span>
                        </span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                    </a>
                </div>

            </div>

            <!-- Sidebar Footer Log Out -->
            <div class="p-4 border-t border-[#2e3a4b]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/20 text-xs font-semibold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ============================================== -->
        <!-- TAILADMIN CONTENT WRAPPER (RIGHT AREA) -->
        <!-- ============================================== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden min-h-screen lg:ml-64 bg-[#f8fafc] dark:bg-[#0f172a] transition-colors duration-200">
            
            <!-- TAILADMIN STICKY TOP HEADER -->
            <header class="sticky top-0 z-30 flex w-full bg-white/95 dark:bg-[#1c2434]/95 backdrop-blur-md border-b border-slate-200 dark:border-[#2e3a4b] transition-colors duration-200">
                <div class="flex flex-grow items-center justify-between px-4 py-3.5 sm:px-6 md:px-8">
                    
                    <!-- Left: Hamburger Toggle for Mobile & Search Bar Preview -->
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = !sidebarOpen" class="block lg:hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-2 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        </button>

                        <div class="hidden sm:flex items-center gap-2 text-xs text-slate-400 dark:text-slate-400">
                            <span class="font-medium text-slate-700 dark:text-slate-200">Dashboard Portal</span>
                            <span>/</span>
                            <span class="capitalize text-brand-600 dark:text-brand-400 font-semibold">{{ $userRole }} Area</span>
                        </div>
                    </div>

                    <!-- Right: Actions (Role Badge, Dark Mode Switcher, User Dropdown) -->
                    <div class="flex items-center gap-3">
                        
                        <!-- Peran Badge (TailAdmin Pill) -->
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold border {{ $roleColor }}">
                            <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $roleDot }}"></span>
                            {{ $roleBadge }}
                        </span>

                        <!-- Dark Mode Toggle Button (TailAdmin Pill Switcher) -->
                        <button id="theme-toggle" type="button" class="relative flex h-8.5 w-8.5 items-center justify-center rounded-lg border border-slate-200 dark:border-[#2e3a4b] bg-white dark:bg-[#243044] text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition p-2" title="Ganti Mode Gelap/Terang">
                            <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            </svg>
                        </button>

                        <!-- User Profile Dropdown -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-2.5 p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                    <div class="w-8 h-8 rounded-lg bg-brand-600 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div class="hidden md:block text-left">
                                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-200 leading-tight max-w-[110px] truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-[10px] text-slate-400 capitalize">{{ $userRole }}</p>
                                    </div>
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 text-[11px] border-b border-slate-100 dark:border-slate-800 text-slate-400">
                                    Masuk sebagai <strong class="text-slate-700 dark:text-slate-200 block truncate">{{ Auth::user()->name }}</strong>
                                </div>
                                <x-dropdown-link :href="route('profile.edit')" class="text-xs">
                                    {{ __('Pengaturan Profil') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-xs text-rose-600 dark:text-rose-400">
                                        {{ __('Keluar Akun') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>

                    </div>
                </div>
            </header>

            <!-- MAIN BODY CONTENT -->
            <main class="flex-1 p-4 sm:p-6 md:p-8">
                {{ $slot }}
            </main>

            <!-- FOOTER -->
            <footer class="py-4 px-6 text-center text-xs text-slate-400 dark:text-slate-500 border-t border-slate-200 dark:border-[#2e3a4b] bg-white/70 dark:bg-[#1c2434]/70 backdrop-blur-sm mt-auto">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>TailAdmin LMS H5P Interaktif &bull; Sistem Pendidikan Cerdas</span>
                    </div>
                    <div>&copy; {{ date('Y') }} Hak Cipta Dilindungi</div>
                </div>
            </footer>
        </div>

        <!-- SweetAlert2 Handler untuk Flash Session Global -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if(session('sukses') || session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('sukses') ?? session('success') }}",
                        confirmButtonText: 'Selesai',
                        confirmButtonColor: '#4f46e5',
                        customClass: {
                            confirmButton: 'px-5 py-2 rounded-lg font-medium text-xs'
                        }
                    });
                @endif

                @if(session('error') || session('gagal'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: "{{ session('error') ?? session('gagal') }}",
                        confirmButtonText: 'Tutup',
                        confirmButtonColor: '#e11d48',
                        customClass: {
                            confirmButton: 'px-5 py-2 rounded-lg font-medium text-xs'
                        }
                    });
                @endif

                @if($errors->any())
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan Validasi',
                        html: '<ul class="text-left text-xs space-y-1 list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                        confirmButtonText: 'Perbaiki',
                        confirmButtonColor: '#f59e0b',
                        customClass: {
                            confirmButton: 'px-5 py-2 rounded-lg font-medium text-xs'
                        }
                    });
                @endif
            });

            // TailAdmin Light/Dark Theme Switcher logic
            const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
            const themeToggleBtn = document.getElementById('theme-toggle');

            function syncThemeIcons() {
                if (document.documentElement.classList.contains('dark')) {
                    if (themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
                    if (themeToggleDarkIcon) themeToggleDarkIcon.classList.add('hidden');
                } else {
                    if (themeToggleLightIcon) themeToggleLightIcon.classList.add('hidden');
                    if (themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
                }
            }

            syncThemeIcons();

            function toggleTheme() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
                syncThemeIcons();
            }

            if (themeToggleBtn) themeToggleBtn.addEventListener('click', toggleTheme);
        </script>
    </body>
</html>
