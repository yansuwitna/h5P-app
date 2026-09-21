<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    settings: Object,
    totalMateri: Number,
    totalGuru: Number,
    totalSiswa: Number,
    auth: Object,
});

const isDark = ref(false);
const mobileMenuOpen = ref(false);

const toggleTheme = () => {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('color-theme', 'light');
        isDark.value = false;
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('color-theme', 'dark');
        isDark.value = true;
    }
};

onMounted(() => {
    isDark.value = document.documentElement.classList.contains('dark');
});
</script>

<template>
    <div class="antialiased bg-slate-50 dark:bg-[#0f172a] text-slate-800 dark:text-slate-100 min-h-screen flex flex-col font-sans selection:bg-brand-500 selection:text-white transition-colors duration-200">
        <Head title="Platform LMS H5P Interaktif" />

        <!-- 1. Navigation Header -->
        <header class="sticky top-0 z-40 bg-white/90 dark:bg-[#1e293b]/90 backdrop-blur-md border-b border-slate-200/80 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Brand Logo -->
                    <Link href="/" class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-brand-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-brand-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <div class="leading-none">
                            <span class="text-base font-bold text-slate-900 dark:text-white tracking-tight">
                                {{ settings?.brand_name || 'H5PClass' }}
                            </span>
                            <span class="block text-[10px] text-slate-400 font-semibold tracking-wider uppercase mt-0.5">Platform Edukasi</span>
                        </div>
                    </Link>

                    <!-- Desktop Nav Links -->
                    <nav class="hidden md:flex items-center space-x-7 text-xs font-semibold text-slate-600 dark:text-slate-300">
                        <a href="#fitur" class="hover:text-brand-600 dark:hover:text-brand-400 transition">{{ settings?.nav_link_1 || 'Fitur Unggulan' }}</a>
                        <a href="#alur" class="hover:text-brand-600 dark:hover:text-brand-400 transition">{{ settings?.nav_link_2 || 'Alur Kerja' }}</a>
                        <a href="#penilaian" class="hover:text-brand-600 dark:hover:text-brand-400 transition">{{ settings?.nav_link_3 || 'Standar Penilaian' }}</a>
                    </nav>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3">
                        <button @click="toggleTheme" type="button" class="p-2 rounded-xl text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700/80 transition" title="Ganti Mode">
                            <span v-if="!isDark" class="text-sm">🌙</span>
                            <span v-else class="text-sm">☀️</span>
                        </button>

                        <Link v-if="auth?.user" href="/beranda" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold shadow-sm transition">
                            <span>Buka Portal</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </Link>
                        <Link v-else href="/login" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold shadow-sm transition">
                            <span>Masuk Portal</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </Link>

                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="md:hidden p-2 rounded-xl text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Drawer -->
            <div v-show="mobileMenuOpen" class="md:hidden border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-[#1e293b] px-4 py-3 space-y-2">
                <a href="#fitur" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ settings?.nav_link_1 || 'Fitur Unggulan' }}</a>
                <a href="#alur" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ settings?.nav_link_2 || 'Alur Kerja' }}</a>
                <a href="#penilaian" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ settings?.nav_link_3 || 'Standar Penilaian' }}</a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            <!-- 2. Hero Section -->
            <section class="py-16 sm:py-24 bg-white dark:bg-[#1e293b]/50 border-b border-slate-200 dark:border-slate-800 relative">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 dark:bg-brand-950/60 border border-brand-200 dark:border-brand-800/80 text-brand-700 dark:text-brand-300 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>{{ settings?.hero_badge || 'Platform LMS Generasi Masa Depan' }}</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-[1.2]">
                        {{ settings?.hero_title || 'Belajar Mandiri Lebih Seru dengan Modul Interaktif H5P' }}
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-2xl mx-auto leading-relaxed">
                        {{ settings?.hero_subtitle || 'Ekosistem pembelajaran berbasis kuis interaktif, video analitis, dan gamifikasi lencana prestasi otomatis yang terukur untuk pengalaman belajar mandiri.' }}
                    </p>

                    <!-- CTAs -->
                    <div class="flex items-center justify-center gap-3 pt-2">
                        <Link href="/login" class="px-6 py-3 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs sm:text-sm shadow-md shadow-brand-500/20 transition inline-flex items-center gap-2">
                            <span>{{ settings?.hero_cta_text || 'Mulai Belajar Sekarang' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </Link>
                        <a href="#alur" class="px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-semibold text-xs sm:text-sm transition border border-slate-200 dark:border-slate-700">
                            Pelajari Alur
                        </a>
                    </div>
                </div>
            </section>

            <!-- 3. Stat Bar -->
            <section class="py-12 bg-slate-50 dark:bg-[#0f172a] border-b border-slate-200 dark:border-slate-800">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Stat 1 -->
                        <div class="p-6 rounded-2xl bg-white dark:bg-[#1e293b] border border-slate-200/90 dark:border-slate-800 shadow-sm flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-brand-50 dark:bg-brand-950/80 text-brand-600 dark:text-brand-400 flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-slate-900 dark:text-white font-mono leading-none">{{ totalMateri }}</div>
                                <div class="text-xs font-bold text-slate-900 dark:text-white mt-1.5">Materi Interaktif H5P</div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Modul aktif siap dipelajari</div>
                            </div>
                        </div>

                        <!-- Stat 2 -->
                        <div class="p-6 rounded-2xl bg-white dark:bg-[#1e293b] border border-slate-200/90 dark:border-slate-800 shadow-sm flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-emerald-50 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/></svg>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-slate-900 dark:text-white font-mono leading-none">{{ totalGuru }}</div>
                                <div class="text-xs font-bold text-slate-900 dark:text-white mt-1.5">Tenaga Pengajar</div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Guru pembuat modul terverifikasi</div>
                            </div>
                        </div>

                        <!-- Stat 3 -->
                        <div class="p-6 rounded-2xl bg-white dark:bg-[#1e293b] border border-slate-200/90 dark:border-slate-800 shadow-sm flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-blue-50 dark:bg-blue-950/80 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-slate-900 dark:text-white font-mono leading-none">{{ totalSiswa }}</div>
                                <div class="text-xs font-bold text-slate-900 dark:text-white mt-1.5">Peserta Didik</div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Siswa belajar mandiri aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 4. Fitur Unggulan -->
            <section id="fitur" class="py-16 sm:py-20 bg-white dark:bg-[#1e293b]/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                    <div class="max-w-2xl">
                        <span class="text-xs font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400">{{ settings?.feature_tagline || 'Kemampuan Sistem' }}</span>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">{{ settings?.feature_heading || 'Dirancang untuk Skalabilitas Kelas' }}</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-7 rounded-2xl bg-slate-50 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-800 space-y-3 hover:border-brand-500/50 transition">
                            <div class="w-11 h-11 rounded-xl bg-brand-100 dark:bg-brand-950 text-brand-600 dark:text-brand-400 flex items-center justify-center text-xl font-bold">⚡</div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ settings?.feature_1_title || 'Integrasi H5P Tanpa Batas' }}</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ settings?.feature_1_desc || 'Dukungan penuh ragam format konten interaktif dari Lumi maupun Canva dengan ekstraksi instan.' }}</p>
                        </div>
                        <div class="p-7 rounded-2xl bg-slate-50 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-800 space-y-3 hover:border-emerald-500/50 transition">
                            <div class="w-11 h-11 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl font-bold">🎯</div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ settings?.feature_2_title || 'Penilaian Real-time xAPI' }}</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ settings?.feature_2_desc || 'Setiap interaksi jawaban siswa langsung terekam otomatis dan dikonversi menjadi laporan capaian.' }}</p>
                        </div>
                        <div class="p-7 rounded-2xl bg-slate-50 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-800 space-y-3 hover:border-amber-500/50 transition">
                            <div class="w-11 h-11 rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl font-bold">🏅</div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ settings?.feature_3_title || 'Gamifikasi & Lencana' }}</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ settings?.feature_3_desc || 'Motivasi belajar siswa dengan penghargaan lencana Emas, Perak, dan Perunggu berdasarkan capaian kuis.' }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 5. Alur Kerja -->
            <section id="alur" class="py-16 sm:py-20 bg-slate-50 dark:bg-[#0f172a] border-y border-slate-200 dark:border-slate-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                    <div class="max-w-2xl">
                        <span class="text-xs font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400">Alur Kerja Terpadu</span>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">Bagaimana Sistem Beroperasi</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Admin -->
                        <div class="p-7 rounded-2xl bg-white dark:bg-[#1e293b] border border-slate-200 dark:border-slate-800 space-y-3 shadow-sm">
                            <div class="inline-block px-2.5 py-1 rounded-md text-[10px] font-mono font-bold bg-brand-50 dark:bg-brand-950 text-brand-700 dark:text-brand-300 border border-brand-200 dark:border-brand-900">
                                01. ADMIN • /admin
                            </div>
                            <h4 class="font-bold text-base text-slate-900 dark:text-white">Pusat Pendaftaran Akun</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Admin mengimpor akun guru dan siswa massal melalui Excel/CSV, memantau daftar materi di database, serta mengatur tata cara operasional dan CMS.
                            </p>
                        </div>

                        <!-- Guru -->
                        <div class="p-7 rounded-2xl bg-white dark:bg-[#1e293b] border border-slate-200 dark:border-slate-800 space-y-3 shadow-sm">
                            <div class="inline-block px-2.5 py-1 rounded-md text-[10px] font-mono font-bold bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900">
                                02. GURU • /guru
                            </div>
                            <h4 class="font-bold text-base text-slate-900 dark:text-white">Publikasi Modul Pembelajaran</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Guru login menggunakan NIK, mengunggah paket materi berformat .h5p interaktif, serta memantau perkembangan nilai dan rapor siswa binaan.
                            </p>
                        </div>

                        <!-- Siswa -->
                        <div class="p-7 rounded-2xl bg-white dark:bg-[#1e293b] border border-slate-200 dark:border-slate-800 space-y-3 shadow-sm">
                            <div class="inline-block px-2.5 py-1 rounded-md text-[10px] font-mono font-bold bg-blue-50 dark:bg-blue-950 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-900">
                                03. SISWA • /siswa
                            </div>
                            <h4 class="font-bold text-base text-slate-900 dark:text-white">Eksplorasi Belajar Mandiri</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Siswa login menggunakan NISN, memilih materi pembelajaran interaktif secara mandiri, menyelesaikan kuis, dan meraih lencana prestasi.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 6. Standar Penilaian -->
            <section id="penilaian" class="py-16 sm:py-20 bg-white dark:bg-[#1e293b]/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                    <div class="max-w-2xl">
                        <span class="text-xs font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400">Evaluasi & Standar Kelulusan</span>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">Tingkatan Penghargaan Belajar</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Emas -->
                        <div class="p-7 rounded-2xl bg-slate-50 dark:bg-[#1e293b] border border-amber-200 dark:border-amber-900/60 space-y-3">
                            <span class="text-3xl">🥇</span>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">Lencana Emas (&ge; 90% Skor)</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Penguasaan materi sempurna dengan akurasi pengerjaan tinggi pada setiap aktivitas kuis modul H5P.
                            </p>
                        </div>

                        <!-- Perak -->
                        <div class="p-7 rounded-2xl bg-slate-50 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-800 space-y-3">
                            <span class="text-3xl">🥈</span>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">Lencana Perak (75% - 89% Skor)</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Pencapaian kompetensi belajar yang baik di atas ambang batas standar kelulusan sekolah.
                            </p>
                        </div>

                        <!-- Perunggu -->
                        <div class="p-7 rounded-2xl bg-slate-50 dark:bg-[#1e293b] border border-orange-200 dark:border-orange-900/60 space-y-3">
                            <span class="text-3xl">🥉</span>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">Lencana Perunggu (&lt; 75% Skor)</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Apresiasi partisipasi awal bagi siswa untuk mengulang modul interaktif dan meningkatkan pemahaman.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="py-8 border-t border-slate-200 dark:border-slate-800 text-xs text-slate-500 dark:text-slate-400 bg-white dark:bg-[#1e293b]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
                <span>{{ settings?.footer_text || 'LMS H5P Interaktif • Sistem Pembelajaran Mandiri Terpadu' }}</span>
                <span>&copy; {{ new Date().getFullYear() }} {{ settings?.footer_copyright || 'Hak Cipta Dilindungi' }}</span>
            </div>
        </footer>
    </div>
</template>
