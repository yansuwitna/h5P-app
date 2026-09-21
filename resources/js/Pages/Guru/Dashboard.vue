<script setup>
import { computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    siswa: Array,
    materi: Array,
});

const page = usePage();
const auth = computed(() => page.props.auth || {});
const user = computed(() => auth.value.user || {});
</script>

<template>
    <AppLayout>
        <Head title="Panel Pengelolaan Guru" />

        <div class="space-y-6">
            <!-- Section: Ringkasan Guru TailAdmin Style -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] p-6 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                            Panel Pengelolaan Guru
                        </h1>
                        <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm mt-0.5">
                            Pantau aktivitas siswa kelas dan publikasikan modul pembelajaran interaktif H5P.
                        </p>
                    </div>
                </div>

                <!-- 3 Kartu Metrik -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-5">
                    <div class="p-5 rounded-2xl bg-slate-50/70 dark:bg-[#243044]/60 border border-slate-200 dark:border-[#2e3a4b]">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Siswa Terdaftar</span>
                        <span class="text-2xl font-bold text-slate-900 dark:text-white mt-1 block font-mono">{{ siswa?.length ?? 0 }}</span>
                        <span class="text-xs text-brand-600 dark:text-brand-400 mt-0.5 block font-medium">Peserta Didik Aktif</span>
                    </div>
                    <div class="p-5 rounded-2xl bg-slate-50/70 dark:bg-[#243044]/60 border border-slate-200 dark:border-[#2e3a4b]">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Modul Diterbitkan</span>
                        <span class="text-2xl font-bold text-slate-900 dark:text-white mt-1 block font-mono">{{ materi?.length ?? 0 }}</span>
                        <span class="text-xs text-purple-600 dark:text-purple-400 mt-0.5 block font-medium">Materi Interaktif</span>
                    </div>
                    <div class="p-5 rounded-2xl bg-slate-50/70 dark:bg-[#243044]/60 border border-slate-200 dark:border-[#2e3a4b]">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Status Parser H5P</span>
                        <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1 block">Siap / Aktif</span>
                        <span class="text-xs text-slate-400 mt-0.5 block font-medium">Standalone Player Engine</span>
                    </div>
                </div>
            </div>

            <!-- Grid Tautan Akses Menu Guru -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                <!-- Ringkasan Siswa Kelas -->
                <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm space-y-4">
                    <div class="border-b border-slate-100 dark:border-[#2e3a4b] pb-3 flex items-center justify-between">
                        <div>
                            <h2 class="text-base font-bold text-slate-900 dark:text-white">Daftar Siswa Kelas</h2>
                            <p class="text-xs text-slate-400">Peserta didik yang siap mengikuti pembelajaran</p>
                        </div>
                        <Link href="/guru/siswa" class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">
                            Lihat Semua &rarr;
                        </Link>
                    </div>

                    <div class="space-y-2 max-h-72 overflow-y-auto pr-1">
                        <div v-for="s in (siswa || []).slice(0, 6)" :key="s.id" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-[#243044]/50 border border-slate-200/60 dark:border-[#2e3a4b] text-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 rounded-lg bg-indigo-50 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-xs">
                                    {{ (s.name || 'S').charAt(0).toUpperCase() }}
                                </div>
                                <span class="font-medium text-slate-800 dark:text-slate-200">{{ s.name }}</span>
                            </div>
                            <span class="font-mono text-slate-500">{{ s.nisn }}</span>
                        </div>
                        <p v-if="!siswa || siswa.length === 0" class="text-xs text-slate-400 py-4 text-center">Belum ada siswa terdaftar.</p>
                    </div>
                </div>

                <!-- Akses Unggah & Modul Terbit -->
                <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm space-y-4">
                    <div class="border-b border-slate-100 dark:border-[#2e3a4b] pb-3 flex items-center justify-between">
                        <div>
                            <h2 class="text-base font-bold text-slate-900 dark:text-white">Modul H5P Terbit</h2>
                            <p class="text-xs text-slate-400">Materi kuis interaktif yang dapat diakses siswa</p>
                        </div>
                        <Link href="/guru/materi" class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">
                            Kelola Modul &rarr;
                        </Link>
                    </div>

                    <div class="space-y-2 max-h-72 overflow-y-auto pr-1">
                        <div v-for="m in (materi || []).slice(0, 6)" :key="m.id" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-[#243044]/50 border border-slate-200/60 dark:border-[#2e3a4b] text-xs">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 rounded-lg bg-purple-50 dark:bg-purple-950 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold text-[10px]">
                                    H5P
                                </span>
                                <span class="font-medium text-slate-800 dark:text-slate-200 truncate max-w-xs">{{ m.judul }}</span>
                            </div>
                            <a :href="`/materi/kerjakan/${m.id}`" target="_blank" class="text-brand-600 dark:text-brand-400 hover:underline font-semibold shrink-0">Pratinjau</a>
                        </div>
                        <p v-if="!materi || materi.length === 0" class="text-xs text-slate-400 py-4 text-center">Belum ada modul diunggah.</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
