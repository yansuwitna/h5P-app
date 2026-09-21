<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    daftarMateri: Array,
});

const formatDate = (dateStr) => {
    if (!dateStr) return '-';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
};
</script>

<template>
    <AppLayout>
        <Head title="Manajemen Modul H5P" />

        <div class="space-y-6">
            <!-- Header Halaman Modul H5P Admin -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#1c2434] p-5 sm:p-6 rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 text-xs font-semibold mb-1">
                        <span>Pusat Modul Interaktif</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                        Katalog & Monitoring Modul H5P
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                        Tinjau seluruh materi pembelajaran interaktif yang telah diunggah oleh para tenaga pendidik di sekolah.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-[#243044] text-slate-700 dark:text-slate-200 font-semibold border border-slate-200 dark:border-[#2e3a4b]">
                        Total: {{ daftarMateri?.length ?? 0 }} Modul Terbit
                    </span>
                </div>
            </div>

            <!-- Tabel Modul H5P Keseluruhan -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-200 dark:border-[#2e3a4b] flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Daftar Modul H5P yang Aktif</h3>
                        <p class="text-xs text-slate-400">Seluruh modul pembelajaran interaktif yang dapat diakses peserta didik secara mandiri</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="bg-slate-50/70 dark:bg-[#243044] text-slate-500 dark:text-slate-400 uppercase font-semibold text-[11px] border-b border-slate-200 dark:border-[#2e3a4b]">
                            <tr>
                                <th class="py-3.5 px-6">Judul Modul Pembelajaran</th>
                                <th class="py-3.5 px-6">Guru Pembuat</th>
                                <th class="py-3.5 px-6">Nama Folder / ID Konten</th>
                                <th class="py-3.5 px-6">Waktu Terbit</th>
                                <th class="py-3.5 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-[#2e3a4b]">
                            <tr v-for="m in daftarMateri" :key="m.id" class="hover:bg-slate-50/50 dark:hover:bg-[#243044]/40 transition">
                                <td class="py-3.5 px-6 font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold text-xs">
                                        H5P
                                    </div>
                                    <span class="max-w-md truncate">{{ m.judul }}</span>
                                </td>
                                <td class="py-3.5 px-6 text-slate-700 dark:text-slate-300">
                                    <span class="font-medium">{{ m.guru?.name ?? 'Tenaga Pendidik' }}</span>
                                    <span class="block text-[11px] text-slate-400 font-mono">{{ m.guru?.nik ? 'NIK: ' + m.guru.nik : '-' }}</span>
                                </td>
                                <td class="py-3.5 px-6 font-mono text-slate-500">{{ m.nama_folder }}</td>
                                <td class="py-3.5 px-6 text-slate-400">{{ formatDate(m.created_at) }}</td>
                                <td class="py-3.5 px-6 text-right">
                                    <a :href="`/materi/kerjakan/${m.id}`" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-purple-50 hover:bg-purple-100 dark:bg-purple-950/60 dark:hover:bg-purple-900/60 text-purple-600 dark:text-purple-400 text-xs font-semibold transition border border-purple-200 dark:border-purple-800">
                                        <span>Pratinjau Modul</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                    </a>
                                </td>
                            </tr>
                            <tr v-if="!daftarMateri || daftarMateri.length === 0">
                                <td colspan="5" class="py-8 text-center text-slate-400">Belum ada modul pembelajaran H5P yang diunggah.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
