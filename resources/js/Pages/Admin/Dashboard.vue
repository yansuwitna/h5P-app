<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    totalGuru: Number,
    totalSiswa: Number,
    totalMateri: Number,
});

const page = usePage();
const auth = page.props.auth || {};
const user = auth.user || {};
</script>

<template>
    <AppLayout>
        <Head title="Panel Administrator" />

        <div class="space-y-6">
            <!-- Hero Banner Admin TailAdmin Style -->
            <div class="relative rounded-2xl overflow-hidden shadow-sm bg-gradient-to-br from-slate-900 via-[#1c2434] to-brand-950 border border-slate-700/50 p-6 sm:p-8 text-white">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/20 backdrop-blur-md text-xs font-bold uppercase tracking-wider text-rose-300 border border-rose-400/30">
                            <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
                            Panel Utama Administrator
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
                            Selamat Datang, Administrator Utama
                        </h1>
                        <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                            Pusat kendali akun guru, siswa, konten interaktif H5P, dan pengaturan tampilan platform sekolah.
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-4 shrink-0 text-center">
                        <div class="text-[11px] text-slate-300 uppercase font-bold tracking-wider">Akun Login Aktif</div>
                        <div class="text-lg font-bold text-white mt-0.5 font-mono">{{ user?.username ?? 'admin' }}</div>
                        <div class="text-[10px] text-emerald-400 font-semibold mt-0.5">Otoritas Penuh</div>
                    </div>
                </div>
            </div>

            <!-- Stats Metric Cards (TailAdmin Standard) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Guru</p>
                        <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-1 font-mono">{{ totalGuru }}</h3>
                        <p class="text-xs text-brand-600 dark:text-brand-400 mt-1 font-medium">Tenaga Pendidik Aktif</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl">
                        👨‍🏫
                    </div>
                </div>

                <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Siswa</p>
                        <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-1 font-mono">{{ totalSiswa }}</h3>
                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1 font-medium">Peserta Didik Terdaftar</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl">
                        🎒
                    </div>
                </div>

                <Link href="/admin/materi" class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] hover:border-purple-500 transition shadow-sm flex items-center justify-between group">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Modul H5P</p>
                        <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-1 font-mono">{{ totalMateri }}</h3>
                        <p class="text-xs text-purple-600 dark:text-purple-400 mt-1 font-medium group-hover:underline">Kelola Modul Terbit &rarr;</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl">
                        ⚡
                    </div>
                </Link>
            </div>

            <!-- Tata Cara Menggunakan Aplikasi Sebagai Admin -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm p-6 sm:p-8 space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 dark:border-[#2e3a4b] pb-4">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-brand-50 dark:bg-brand-950/60 text-brand-600 dark:text-brand-400 text-xs font-semibold mb-1">
                            <span>Panduan Operasional</span>
                        </div>
                        <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">
                            Tata Cara Menggunakan Aplikasi Sebagai Admin
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                            Ikuti langkah-langkah terstruktur berikut untuk mengelola seluruh ekosistem pembelajaran sekolah secara efektif dan optimal.
                        </p>
                    </div>
                    <div class="text-xs font-semibold px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-[#243044] text-slate-700 dark:text-slate-300 self-start sm:self-auto border border-slate-200 dark:border-[#2e3a4b]">
                        4 Langkah Utama
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Langkah 1: Manajemen Akun Guru -->
                    <div class="p-5 rounded-2xl bg-slate-50/70 dark:bg-[#243044]/50 border border-slate-200 dark:border-[#2e3a4b] flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-base shrink-0 shadow-md shadow-indigo-500/20">
                            1
                        </div>
                        <div class="space-y-2">
                            <h3 class="font-bold text-sm text-slate-900 dark:text-white">1. Menambahkan Akun Tenaga Pendidik (Guru)</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                Masuk ke menu <Link href="/admin/guru" class="font-semibold text-brand-600 dark:text-brand-400 hover:underline">Data Guru</Link>. Anda dapat mengunggah berkas Excel/CSV secara massal atau menambahkan akun satu per satu secara manual. Setiap akun guru login menggunakan <strong>NIK</strong>.
                            </p>
                            <Link href="/admin/guru" class="inline-flex items-center gap-1 text-xs font-semibold text-brand-600 dark:text-brand-400 hover:text-brand-700">
                                <span>Buka Halaman Guru</span> &rarr;
                            </Link>
                        </div>
                    </div>

                    <!-- Langkah 2: Manajemen Akun Siswa -->
                    <div class="p-5 rounded-2xl bg-slate-50/70 dark:bg-[#243044]/50 border border-slate-200 dark:border-[#2e3a4b] flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-base shrink-0 shadow-md shadow-blue-500/20">
                            2
                        </div>
                        <div class="space-y-2">
                            <h3 class="font-bold text-sm text-slate-900 dark:text-white">2. Menambahkan Akun Peserta Didik (Siswa)</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                Masuk ke menu <Link href="/admin/siswa" class="font-semibold text-blue-600 dark:text-blue-400 hover:underline">Data Siswa</Link>. Import daftar nama siswa beserta <strong>NISN</strong> via file spreadsheet. Siswa menggunakan NISN dan kata sandi yang telah diatur untuk login mandiri.
                            </p>
                            <Link href="/admin/siswa" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700">
                                <span>Buka Halaman Siswa</span> &rarr;
                            </Link>
                        </div>
                    </div>

                    <!-- Langkah 3: Mengelola Teks Beranda & Branding -->
                    <div class="p-5 rounded-2xl bg-slate-50/70 dark:bg-[#243044]/50 border border-slate-200 dark:border-[#2e3a4b] flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center font-bold text-base shrink-0 shadow-md shadow-purple-500/20">
                            3
                        </div>
                        <div class="space-y-2">
                            <h3 class="font-bold text-sm text-slate-900 dark:text-white">3. Mengatur Teks & Identitas Landing Page</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                Gunakan menu <Link href="/admin/cms" class="font-semibold text-purple-600 dark:text-purple-400 hover:underline">CMS Landing Page</Link> untuk menyesuaikan nama sekolah/brand, judul promosi, deskripsi fitur, hingga teks hak cipta pada beranda publik tanpa perlu mengubah kode sumber.
                            </p>
                            <Link href="/admin/cms" class="inline-flex items-center gap-1 text-xs font-semibold text-purple-600 dark:text-purple-400 hover:text-purple-700">
                                <span>Kustomisasi Landing Page</span> &rarr;
                            </Link>
                        </div>
                    </div>

                    <!-- Langkah 4: Memantau Pembelajaran & Evaluasi -->
                    <div class="p-5 rounded-2xl bg-slate-50/70 dark:bg-[#243044]/50 border border-slate-200 dark:border-[#2e3a4b] flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-base shrink-0 shadow-md shadow-emerald-500/20">
                            4
                        </div>
                        <div class="space-y-2">
                            <h3 class="font-bold text-sm text-slate-900 dark:text-white">4. Memantau Aktivitas Pembelajaran & Modul</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                Guru yang telah dibuat akunnya akan login untuk mengunggah materi kuis H5P. Siswa dapat mengerjakan modul tersebut secara mandiri dan hasilnya akan langsung tercatat di rapor nilai interaktif.
                            </p>
                            <span class="inline-flex items-center gap-1.5 text-xs text-emerald-600 dark:text-emerald-400 font-semibold">
                                <span>Status Sistem: Siap & Aktif</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
