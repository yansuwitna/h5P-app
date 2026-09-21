<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    siswa: Array,
});
</script>

<template>
    <AppLayout>
        <Head title="Daftar Siswa Kelas Aktif" />

        <div class="space-y-6">
            <!-- Header Halaman -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#1c2434] p-5 sm:p-6 rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 text-xs font-semibold mb-1">
                        <span>Siswa Binaan</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                        Daftar Siswa Kelas Aktif
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                        Data peserta didik aktif yang terdaftar untuk mengikuti pembelajaran dan pengerjaan modul Anda.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-[#243044] text-slate-700 dark:text-slate-200 font-semibold border border-slate-200 dark:border-[#2e3a4b]">
                        {{ siswa?.length ?? 0 }} Siswa Aktif
                    </span>
                </div>
            </div>

            <!-- Tabel Siswa -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="bg-slate-50/70 dark:bg-[#243044] text-slate-500 dark:text-slate-400 uppercase font-semibold text-[11px] border-b border-slate-200 dark:border-[#2e3a4b]">
                            <tr>
                                <th class="py-3.5 px-6">Nama Siswa</th>
                                <th class="py-3.5 px-6">NISN (Login Siswa)</th>
                                <th class="py-3.5 px-6">Alamat Email</th>
                                <th class="py-3.5 px-6">Status Akun</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-[#2e3a4b]">
                            <tr v-for="s in siswa" :key="s.id" class="hover:bg-slate-50/50 dark:hover:bg-[#243044]/40 transition">
                                <td class="py-3.5 px-6 font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-xs">
                                        {{ (s.name || 'S').charAt(0).toUpperCase() }}
                                    </div>
                                    <span>{{ s.name }}</span>
                                </td>
                                <td class="py-3.5 px-6 font-mono font-semibold text-emerald-600 dark:text-emerald-400">{{ s.nisn }}</td>
                                <td class="py-3.5 px-6 text-slate-500">{{ s.email || '-' }}</td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        Siap Belajar
                                    </span>
                                </td>
                            </tr>
                            <tr v-if="!siswa || siswa.length === 0">
                                <td colspan="4" class="py-8 text-center text-slate-400">Belum ada peserta didik yang terdaftar dalam sistem.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
