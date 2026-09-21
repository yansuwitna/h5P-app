<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H5P Class &bull; Platform Pembelajaran Interaktif</title>

    <!-- Dark Mode Instant Init -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 dark:bg-[#090d16] bg-grid-pattern text-slate-800 dark:text-slate-100 transition-colors duration-200 selection:bg-indigo-500 selection:text-white">

    <!-- 1. Navigation Bar (Clean SaaS Navbar) -->
    <nav class="sticky top-0 z-30 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <span class="font-bold text-base tracking-tight text-slate-900 dark:text-white">
                        {{ $settings['brand_name'] ?? 'H5PClass' }}
                    </span>
                </a>

                <!-- Nav Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6 text-xs font-semibold text-slate-600 dark:text-slate-300">
                    <a href="#fitur" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">{{ $settings['nav_link_1'] ?? 'Fitur Unggulan' }}</a>
                    <a href="#alur" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">{{ $settings['nav_link_2'] ?? 'Alur Kerja' }}</a>
                    <a href="#penilaian" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">{{ $settings['nav_link_3'] ?? 'Standar Penilaian' }}</a>
                </div>

                <!-- Action Button & Dark Mode -->
                <div class="flex items-center space-x-3">
                    <button id="theme-toggle" type="button" class="text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg p-2 text-xs border border-slate-200 dark:border-slate-800" title="Ubah Mode Gelap / Terang">
                        <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" /></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /></svg>
                    </button>

                    @auth
                        <a href="{{ route('beranda') }}" class="hidden sm:inline-flex px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition">
                            Masuk Portal
                        </a>
                    @endauth

                    <!-- Mobile Hamburger Button -->
                    <button id="mobile-menu-btn" type="button" class="md:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800" aria-label="Buka Menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Navigation Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 py-3 space-y-2">
            <a href="#fitur" class="block px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ $settings['nav_link_1'] ?? 'Fitur Unggulan' }}</a>
            <a href="#alur" class="block px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ $settings['nav_link_2'] ?? 'Alur Kerja' }}</a>
            <a href="#penilaian" class="block px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ $settings['nav_link_3'] ?? 'Standar Penilaian' }}</a>
            <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                @auth
                    <a href="{{ route('beranda') }}" class="block text-center px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block text-center px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition">
                        Masuk Portal
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- 2. Hero Section (Animated School & Interactive Education Theme) -->
    <section class="py-16 sm:py-24 border-b border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/60 backdrop-blur-sm relative overflow-hidden">
        
        <!-- Floating School Themed Animated Elements -->
        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
            <!-- 1. Top Left: Toga / Topi Kelulusan (Floating) -->
            <div class="absolute -top-4 left-6 sm:left-20 animate-float-slow opacity-80 dark:opacity-60 hidden sm:block">
                <div class="p-3 rounded-2xl bg-indigo-50/80 dark:bg-indigo-950/60 border border-indigo-200/80 dark:border-indigo-800 shadow-sm backdrop-blur-sm flex items-center gap-2">
                    <span class="text-xl">🎓</span>
                    <span class="text-[11px] font-bold text-indigo-700 dark:text-indigo-300">Kelas Cerdas</span>
                </div>
            </div>

            <!-- 2. Top Right: Medali Capaian (Reverse Float) -->
            <div class="absolute top-8 right-6 sm:right-24 animate-float-reverse opacity-85 dark:opacity-60 hidden sm:block">
                <div class="p-3 rounded-2xl bg-amber-50/80 dark:bg-amber-950/60 border border-amber-200/80 dark:border-amber-800 shadow-sm backdrop-blur-sm flex items-center gap-2">
                    <span class="text-xl">🏅</span>
                    <span class="text-[11px] font-bold text-amber-700 dark:text-amber-300">Lencana xAPI</span>
                </div>
            </div>

            <!-- 3. Mid Left: Buku & Catatan Pelajaran -->
            <div class="absolute top-48 -left-4 sm:left-12 animate-float-reverse opacity-75 dark:opacity-50 hidden md:block">
                <div class="p-2.5 rounded-2xl bg-emerald-50/80 dark:bg-emerald-950/60 border border-emerald-200/80 dark:border-emerald-800 shadow-sm backdrop-blur-sm flex items-center gap-2">
                    <span class="text-lg">📚</span>
                    <span class="text-[10px] font-bold text-emerald-700 dark:text-emerald-300">Kurikulum Aktif</span>
                </div>
            </div>

            <!-- 4. Mid Right: Pensil & Penggaris Animasi -->
            <div class="absolute top-52 -right-4 sm:right-16 animate-float-slow opacity-75 dark:opacity-50 hidden md:block">
                <div class="p-2.5 rounded-2xl bg-purple-50/80 dark:bg-purple-950/60 border border-purple-200/80 dark:border-purple-800 shadow-sm backdrop-blur-sm flex items-center gap-2">
                    <span class="text-lg">✏️</span>
                    <span class="text-[10px] font-bold text-purple-700 dark:text-purple-300">Interaktif H5P</span>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6 relative z-10">
            
            <!-- School Pill Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200/80 dark:border-indigo-800 text-indigo-700 dark:text-indigo-300 text-xs font-semibold shadow-sm">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>{{ $settings['hero_badge'] ?? 'Ekosistem Pembelajaran H5P • Versi 2.0' }}</span>
                <span class="text-indigo-400 dark:text-indigo-500">&bull;</span>
                <span class="text-[11px] font-normal text-slate-500 dark:text-slate-400">Ruang Belajar Digital</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-bold tracking-tight text-slate-900 dark:text-white leading-[1.2]">
                {{ $settings['hero_title'] ?? 'Platform Manajemen Materi & Kuis Interaktif Berbasis Standar Industri' }}
            </h1>

            <p class="text-sm sm:text-base text-slate-500 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                {{ $settings['hero_subtitle'] ?? 'Kelola distribusi konten H5P interaktif, pantau ketercapaian belajar siswa secara terpusat, dan integrasikan dengan media penyimpanan fleksibel.' }}
            </p>

            <div class="flex items-center justify-center gap-3 pt-2">
                <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs transition shadow-sm flex items-center gap-2 group">
                    <span>{{ $settings['hero_cta_primary'] ?? 'Masuk ke Portal' }}</span>
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path></svg>
                </a>
                <a href="#alur" class="px-6 py-2.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-semibold text-xs transition border border-slate-200 dark:border-slate-700 flex items-center gap-1.5">
                    <span class="text-xs">🎒</span>
                    <span>{{ $settings['hero_cta_secondary'] ?? 'Pelajari Alur Belajar' }}</span>
                </a>
            </div>

            <!-- Interaktif Animated School Blackboard / Classroom Canvas Preview -->
            <div class="pt-8 max-w-3xl mx-auto">
                <div class="relative rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-gradient-to-b from-slate-900 to-slate-950 text-left shadow-2xl p-5 sm:p-6 overflow-hidden">
                    
                    <!-- Header Bar ala Papan Tulis Kelas -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-800 text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500/80 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500/80 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500/80 inline-block"></span>
                            <span class="ml-2 font-mono text-[11px] text-slate-400">🏫 simulasi-kelas-interaktif.h5p</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-400 text-[11px]">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            <span>Live xAPI Tracker</span>
                        </div>
                    </div>

                    <!-- Isi Papan Tulis Interaktif -->
                    <div class="pt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="p-3 rounded-xl bg-slate-800/60 border border-slate-700/60 space-y-1">
                            <div class="text-[10px] uppercase font-bold text-slate-400 flex items-center gap-1">
                                <span>📖</span> Modul Aktif
                            </div>
                            <div class="text-xs font-semibold text-white truncate">Tata Surya & Eksplorasi Luar Angkasa</div>
                            <div class="text-[10px] text-indigo-400">Format: Course Presentation H5P</div>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-800/60 border border-slate-700/60 space-y-1">
                            <div class="text-[10px] uppercase font-bold text-slate-400 flex items-center gap-1">
                                <span>⚡</span> Evaluasi Kuis
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-emerald-400 font-mono">Skor: 95 / 100</span>
                                <span class="text-xs">🥇</span>
                            </div>
                            <div class="w-full bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 95%"></div>
                            </div>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-800/60 border border-slate-700/60 space-y-1">
                            <div class="text-[10px] uppercase font-bold text-slate-400 flex items-center gap-1">
                                <span>🎯</span> Standar Kelulusan
                            </div>
                            <div class="text-xs font-semibold text-white">Tuntas Kompetensi</div>
                            <div class="text-[10px] text-emerald-400 font-medium">Otomatis Lencana Emas</div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Kartu Statistik Live Metrik Sekolah (Materi, Guru, Siswa) -->
            <div class="pt-8 max-w-4xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    
                    <!-- 1. Total Materi H5P -->
                    <div class="p-5 rounded-2xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 shadow-sm text-left flex items-center gap-4 hover:border-indigo-400 dark:hover:border-indigo-600 transition">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-950/60 border border-purple-200 dark:border-purple-800 flex items-center justify-center text-purple-600 dark:text-purple-400 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Materi Interaktif</span>
                            <div class="flex items-baseline gap-1.5 mt-0.5">
                                <span class="text-2xl sm:text-3xl font-bold font-mono text-slate-900 dark:text-white">{{ $totalMateri ?? 0 }}</span>
                                <span class="text-xs text-purple-600 dark:text-purple-400 font-semibold">Modul H5P</span>
                            </div>
                            <span class="text-[11px] text-slate-400">Tersedia untuk dipelajari</span>
                        </div>
                    </div>

                    <!-- 2. Total Guru -->
                    <div class="p-5 rounded-2xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 shadow-sm text-left flex items-center gap-4 hover:border-indigo-400 dark:hover:border-indigo-600 transition">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200 dark:border-indigo-800 flex items-center justify-center text-indigo-600 dark:text-indigo-400 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Tenaga Pengajar</span>
                            <div class="flex items-baseline gap-1.5 mt-0.5">
                                <span class="text-2xl sm:text-3xl font-bold font-mono text-slate-900 dark:text-white">{{ $totalGuru ?? 0 }}</span>
                                <span class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold">Guru Pengampu</span>
                            </div>
                            <span class="text-[11px] text-slate-400">Pendidik profesional</span>
                        </div>
                    </div>

                    <!-- 3. Total Siswa -->
                    <div class="p-5 rounded-2xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 shadow-sm text-left flex items-center gap-4 hover:border-emerald-400 dark:hover:border-emerald-600 transition">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Peserta Didik</span>
                            <div class="flex items-baseline gap-1.5 mt-0.5">
                                <span class="text-2xl sm:text-3xl font-bold font-mono text-slate-900 dark:text-white">{{ $totalSiswa ?? 0 }}</span>
                                <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">Siswa Aktif</span>
                            </div>
                            <span class="text-[11px] text-slate-400">Terdaftar di sistem</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- 3. Fitur Utama (SaaS Grid) -->
    <section id="fitur" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <div class="max-w-xl space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                    {{ $settings['feature_tagline'] ?? 'Kemampuan Sistem' }}
                </span>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                    {{ $settings['feature_heading'] ?? 'Dirancang untuk Skalabilitas Kelas' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Fitur 1 -->
                <div class="p-6 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200 dark:border-indigo-800 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>
                    </div>
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white">
                        {{ $settings['feature_1_title'] ?? 'Ekstraksi Modul H5P Otomatis' }}
                    </h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        {{ $settings['feature_1_desc'] ?? 'Sistem secara otomatis membongkar arsip materi .h5p ke repositori server sehingga dapat dimainkan langsung di peramban tanpa konfigurasi rumit.' }}
                    </p>
                </div>

                <!-- Fitur 2 -->
                <div class="p-6 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200 dark:border-indigo-800 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" /></svg>
                    </div>
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white">
                        {{ $settings['feature_2_title'] ?? 'Fleksibilitas Media Penyimpanan' }}
                    </h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        {{ $settings['feature_2_desc'] ?? 'Mendukung penyimpanan ganda baik di disk server lokal maupun integrasi langsung dengan Google Drive Cloud via Flysystem API.' }}
                    </p>
                </div>

                <!-- Fitur 3 -->
                <div class="p-6 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200 dark:border-indigo-800 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white">
                        {{ $settings['feature_3_title'] ?? 'Pelacakan xAPI & Evaluasi Nilai' }}
                    </h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        {{ $settings['feature_3_desc'] ?? 'Setiap jawaban yang dikirimkan oleh siswa dicatat secara presisi melalui protokol xAPI standar untuk menghasilkan rekapitulasi nilai dan lencana capaian.' }}
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- 4. Section Alur Kerja (#alur) -->
    <section id="alur" class="py-16 border-t border-slate-200 dark:border-slate-800 bg-white/40 dark:bg-slate-900/40 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="max-w-xl space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 flex items-center gap-1.5">
                    <span class="text-sm">🧭</span> Tahapan Interaksi Sekolah
                </span>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Alur Pembelajaran Terpadu</h2>
                <p class="text-xs text-slate-500 leading-relaxed">Dirancang untuk alur kerja yang intuitif antara Administrator, Guru, dan Siswa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative">
                <!-- Tahap 1: Admin -->
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3 relative group hover:border-indigo-400/60 dark:hover:border-indigo-500/50 transition duration-300 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/80 border border-indigo-200/80 dark:border-indigo-800/80 flex items-center justify-center text-lg animate-float-slow">
                            🛡️
                        </div>
                        <span class="text-xs font-mono font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-50/80 dark:bg-indigo-950/60 px-2.5 py-0.5 rounded-full">Tahap 01</span>
                    </div>
                    <div class="text-[11px] font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Peran Administrator</div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Admin Membuat Akun Guru & Siswa</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Admin mengelola basis data sekolah pusat, membuat akun Guru berbasis NIK dan akun Siswa berbasis NISN secara manual maupun import masal berkas Excel / CSV.</p>
                </div>

                <!-- Tahap 2: Guru -->
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3 relative group hover:border-indigo-400/60 dark:hover:border-indigo-500/50 transition duration-300 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/80 border border-purple-200/80 dark:border-purple-800/80 flex items-center justify-center text-lg animate-float-reverse">
                            👨‍🏫
                        </div>
                        <span class="text-xs font-mono font-bold text-purple-600 dark:text-purple-400 bg-purple-50/80 dark:bg-purple-950/60 px-2.5 py-0.5 rounded-full">Tahap 02</span>
                    </div>
                    <div class="text-[11px] font-semibold text-purple-600 dark:text-purple-400 uppercase tracking-wider">Peran Tenaga Pendidik</div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Guru Login & Membuat Materi</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Guru masuk menggunakan NIK, menyiapkan konten interaktif, dan mengunggah paket materi `.h5p`. Sistem otomatis mengekstrak modul agar siap dimainkan.</p>
                </div>

                <!-- Tahap 3: Siswa -->
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3 relative group hover:border-indigo-400/60 dark:hover:border-indigo-500/50 transition duration-300 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/80 border border-emerald-200/80 dark:border-emerald-800/80 flex items-center justify-center text-lg animate-float-slow">
                            🎒
                        </div>
                        <span class="text-xs font-mono font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50/80 dark:bg-emerald-950/60 px-2.5 py-0.5 rounded-full">Tahap 03</span>
                    </div>
                    <div class="text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Peran Peserta Didik</div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Siswa Memilih Materi Mandiri</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Siswa login menggunakan NISN, bebas menjelajahi katalog modul pembelajaran secara mandiri, mengerjakan evaluasi interaktif, dan meraih lencana penghargaan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Section Standar Penilaian (#penilaian) -->
    <section id="penilaian" class="py-16 border-t border-slate-200 dark:border-slate-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="max-w-xl space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 flex items-center gap-1.5">
                    <span class="text-sm">🎖️</span> Evaluasi & Standar Kelulusan
                </span>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Tingkatan Penghargaan Belajar</h2>
                <p class="text-xs text-slate-500 leading-relaxed">Memberi motivasi nyata bagi siswa dalam menuntaskan modul pelajaran interaktif.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Emas -->
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-amber-200/80 dark:border-amber-900/50 space-y-3 relative hover:scale-[1.02] transition duration-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/70 border border-amber-300 dark:border-amber-700/60 flex items-center justify-center text-2xl animate-bounce-subtle">
                            🥇
                        </div>
                        <span class="text-xs font-bold text-amber-600 dark:text-amber-400 font-mono bg-amber-50 dark:bg-amber-950/60 px-2.5 py-1 rounded-full">&ge; 90% Skor</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Lencana Emas (Sangat Memuaskan)</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Penguasaan materi sempurna dengan akurasi pengerjaan tinggi pada setiap aktivitas soal modul H5P.</p>
                    </div>
                </div>

                <!-- Perak -->
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 space-y-3 relative hover:scale-[1.02] transition duration-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 flex items-center justify-center text-2xl animate-float-reverse">
                            🥈
                        </div>
                        <span class="text-xs font-bold text-slate-600 dark:text-slate-300 font-mono bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-full">75% - 89% Skor</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Lencana Perak (Kompeten)</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Pencapaian kompetensi belajar yang baik di atas ambang batas standar kelulusan sekolah.</p>
                    </div>
                </div>

                <!-- Perunggu -->
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-orange-200/80 dark:border-orange-900/50 space-y-3 relative hover:scale-[1.02] transition duration-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-2xl bg-orange-50 dark:bg-orange-950/70 border border-orange-300 dark:border-orange-700/60 flex items-center justify-center text-2xl animate-float-slow">
                            🥉
                        </div>
                        <span class="text-xs font-bold text-orange-600 dark:text-orange-400 font-mono bg-orange-50 dark:bg-orange-950/60 px-2.5 py-1 rounded-full">&lt; 75% Skor</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Lencana Perunggu (Perlu Latihan)</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Apresiasi partisipasi awal bagi siswa untuk mengulang modul interaktif dan meningkatkan pemahaman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 border-t border-slate-200 dark:border-slate-800 text-xs text-slate-400 text-center bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>{{ $settings['footer_text'] ?? 'H5P Class • Sistem LMS Pembelajaran Terpadu' }}</span>
            <span>&copy; {{ date('Y') }} {{ $settings['footer_copyright'] ?? 'Hak Cipta Dilindungi' }}</span>
        </div>
    </footer>

    <!-- Theme Switcher Script -->
    <script>
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

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
                syncThemeIcons();
            });
        }

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
            // Auto close when clicking a link inside mobile menu
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
            });
        }
    </script>
</body>
</html>
