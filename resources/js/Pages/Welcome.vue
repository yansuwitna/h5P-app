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
    <div class="antialiased bg-slate-50 dark:bg-[#090d16] bg-grid-pattern text-slate-800 dark:text-slate-100 transition-colors duration-200 selection:bg-indigo-500 selection:text-white min-h-screen">
        <Head title="Platform Pembelajaran Interaktif" />

        <!-- 1. Navigation Bar -->
        <nav class="sticky top-0 z-30 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Logo -->
                    <Link href="/" class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <span class="font-bold text-base tracking-tight text-slate-900 dark:text-white">
                            {{ settings?.brand_name || 'H5PClass' }}
                        </span>
                    </Link>

                    <!-- Nav Menu Desktop -->
                    <div class="hidden md:flex items-center space-x-6 text-xs font-semibold text-slate-600 dark:text-slate-300">
                        <a href="#fitur" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">{{ settings?.nav_link_1 || 'Fitur Unggulan' }}</a>
                        <a href="#alur" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">{{ settings?.nav_link_2 || 'Alur Kerja' }}</a>
                        <a href="#penilaian" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">{{ settings?.nav_link_3 || 'Standar Penilaian' }}</a>
                    </div>

                    <!-- Action Button & Dark Mode -->
                    <div class="flex items-center space-x-3">
                        <button @click="toggleTheme" type="button" class="text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg p-2 text-xs border border-slate-200 dark:border-slate-800" title="Ubah Mode Gelap / Terang">
                            <span v-if="!isDark">🌙</span>
                            <span v-else>☀️</span>
                        </button>

                        <Link v-if="auth?.user" href="/beranda" class="hidden sm:inline-flex px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition">
                            Buka Dashboard
                        </Link>
                        <Link v-else href="/login" class="hidden sm:inline-flex px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition">
                            Masuk Portal
                        </Link>

                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="md:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div v-show="mobileMenuOpen" class="md:hidden border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 py-3 space-y-2">
                <a href="#fitur" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ settings?.nav_link_1 || 'Fitur Unggulan' }}</a>
                <a href="#alur" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ settings?.nav_link_2 || 'Alur Kerja' }}</a>
                <a href="#penilaian" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ settings?.nav_link_3 || 'Standar Penilaian' }}</a>
                <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                    <Link v-if="auth?.user" href="/beranda" class="block text-center px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition">
                        Buka Dashboard
                    </Link>
                    <Link v-else href="/login" class="block text-center px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition">
                        Masuk Portal
                    </Link>
                </div>
            </div>
        </nav>

        <!-- 2. Hero Section -->
        <section class="py-16 sm:py-24 border-b border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/60 backdrop-blur-sm relative overflow-hidden">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6 relative z-10">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200/80 dark:border-indigo-800 text-indigo-700 dark:text-indigo-300 text-xs font-semibold shadow-sm">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ settings?.hero_badge || 'Platform LMS Generasi Masa Depan' }}</span>
                    <span class="text-indigo-400 dark:text-indigo-500">&bull;</span>
                    <span class="text-[11px] font-normal text-slate-500 dark:text-slate-400">Ruang Belajar Digital</span>
                </div>

                <h1 class="text-3xl sm:text-5xl font-bold tracking-tight text-slate-900 dark:text-white leading-[1.2]">
                    {{ settings?.hero_title || 'Belajar Mandiri Lebih Seru dengan Modul Interaktif H5P' }}
                </h1>

                <p class="text-sm sm:text-base text-slate-500 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                    {{ settings?.hero_subtitle || 'Ekosistem pembelajaran berbasis kuis interaktif, video analitis, dan gamifikasi lencana prestasi otomatis yang terukur.' }}
                </p>

                <div class="flex items-center justify-center gap-3 pt-2">
                    <Link href="/login" class="px-6 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs transition shadow-sm flex items-center gap-2">
                        <span>{{ settings?.hero_cta_text || 'Mulai Belajar Sekarang' }}</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path></svg>
                    </Link>
                    <a href="#alur" class="px-6 py-2.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-semibold text-xs transition border border-slate-200 dark:border-slate-700 flex items-center gap-1.5">
                        <span class="text-xs">🎒</span>
                        <span>Alur Kerja</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- 3. Stat Bar -->
        <section class="py-10 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                    <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700/60">
                        <div class="text-3xl font-black text-indigo-600 dark:text-indigo-400 font-mono">{{ totalMateri }}</div>
                        <div class="text-xs font-semibold text-slate-900 dark:text-white mt-1">Materi Interaktif H5P</div>
                        <p class="text-[11px] text-slate-400 mt-0.5">Modul pembelajaran terbit</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700/60">
                        <div class="text-3xl font-black text-emerald-600 dark:text-emerald-400 font-mono">{{ totalGuru }}</div>
                        <div class="text-xs font-semibold text-slate-900 dark:text-white mt-1">Tenaga Pengajar</div>
                        <p class="text-[11px] text-slate-400 mt-0.5">Guru pembuat modul aktif</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700/60">
                        <div class="text-3xl font-black text-blue-600 dark:text-blue-400 font-mono">{{ totalSiswa }}</div>
                        <div class="text-xs font-semibold text-slate-900 dark:text-white mt-1">Peserta Didik</div>
                        <p class="text-[11px] text-slate-400 mt-0.5">Siswa belajar mandiri</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Section Fitur Unggulan (#fitur) -->
        <section id="fitur" class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <div class="max-w-xl space-y-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">{{ settings?.feature_tagline || 'Kemampuan Sistem' }}</span>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ settings?.feature_heading || 'Dirancang untuk Skalabilitas Kelas' }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold">⚡</div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ settings?.feature_1_title || 'Integrasi H5P Tanpa Batas' }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ settings?.feature_1_desc || 'Dukungan penuh ragam format konten interaktif dari Lumi maupun Canva dengan ekstraksi instan.' }}</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold">🎯</div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ settings?.feature_2_title || 'Penilaian Real-time xAPI' }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ settings?.feature_2_desc || 'Setiap interaksi jawaban siswa langsung terekam otomatis dan dikonversi menjadi laporan capaian.' }}</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold">🏅</div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ settings?.feature_3_title || 'Gamifikasi & Lencana' }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ settings?.feature_3_desc || 'Motivasi belajar siswa dengan penghargaan lencana Emas, Perak, dan Perunggu berdasarkan capaian kuis.' }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Section Alur Kerja (#alur) -->
        <section id="alur" class="py-16 bg-white dark:bg-slate-900 border-y border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <div class="max-w-xl space-y-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Alur Kerja Terpadu</span>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Bagaimana Sistem Beroperasi</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/60 space-y-2">
                        <span class="text-xs font-mono font-bold text-indigo-600 dark:text-indigo-400">01. ADMIN</span>
                        <h4 class="font-bold text-sm text-slate-900 dark:text-white">Pusat Pendaftaran Akun</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Admin mengimpor data akun guru dan siswa secara massal menggunakan Excel/CSV atau manual.</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/60 space-y-2">
                        <span class="text-xs font-mono font-bold text-indigo-600 dark:text-indigo-400">02. GURU</span>
                        <h4 class="font-bold text-sm text-slate-900 dark:text-white">Publikasi Modul Pembelajaran</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Guru login dengan NIK, mengunggah paket file .h5p interaktif, dan memantau siswa binaan.</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/60 space-y-2">
                        <span class="text-xs font-mono font-bold text-indigo-600 dark:text-indigo-400">03. SISWA</span>
                        <h4 class="font-bold text-sm text-slate-900 dark:text-white">Eksplorasi Belajar Mandiri</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Siswa login dengan NISN, memilih materi yang ingin dikerjakan, dan meraih lencana prestasi.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Section Standar Penilaian (#penilaian) -->
        <section id="penilaian" class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <div class="max-w-xl space-y-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Evaluasi & Standar Kelulusan</span>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Tingkatan Penghargaan Belajar</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-amber-200 dark:border-amber-900/50 space-y-3">
                        <span class="text-3xl">🥇</span>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Lencana Emas (&ge; 90% Skor)</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Penguasaan materi sempurna dengan akurasi pengerjaan tinggi pada setiap aktivitas soal modul H5P.</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 space-y-3">
                        <span class="text-3xl">🥈</span>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Lencana Perak (75% - 89% Skor)</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Pencapaian kompetensi belajar yang baik di atas ambang batas standar kelulusan sekolah.</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-orange-200 dark:border-orange-900/50 space-y-3">
                        <span class="text-3xl">🥉</span>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Lencana Perunggu (&lt; 75% Skor)</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Apresiasi partisipasi awal bagi siswa untuk mengulang modul interaktif dan meningkatkan pemahaman.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-8 border-t border-slate-200 dark:border-slate-800 text-xs text-slate-400 text-center bg-white dark:bg-slate-900">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                <span>{{ settings?.footer_text || 'H5P Class • Sistem LMS Pembelajaran Terpadu' }}</span>
                <span>&copy; {{ new Date().getFullYear() }} {{ settings?.footer_copyright || 'Hak Cipta Dilindungi' }}</span>
            </div>
        </footer>
    </div>
</template>
