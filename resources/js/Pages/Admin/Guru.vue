<script setup>
import { ref } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    daftarGuru: Array,
});

const tab = ref('excel');

const formExcel = useForm({
    file_excel: null,
});

const formManual = useForm({
    nama: '',
    nik: '',
    email: '',
    kata_sandi: '',
});

const handleFileChange = (e) => {
    formExcel.file_excel = e.target.files[0];
};

const submitExcel = () => {
    formExcel.post('/admin/import-guru', {
        onSuccess: () => {
            formExcel.reset();
        },
    });
};

const submitManual = () => {
    formManual.post('/admin/guru-manual', {
        onSuccess: () => {
            formManual.reset();
        },
    });
};

const formatDate = (dateStr) => {
    if (!dateStr) return '-';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
};
</script>

<template>
    <AppLayout>
        <Head title="Manajemen Data Guru" />

        <div class="space-y-6">
            <!-- Header Halaman -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#1c2434] p-5 sm:p-6 rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 text-xs font-semibold mb-1">
                        <span>Manajemen Pendidik</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                        Data Guru Terdaftar
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                        Kelola akun pengajar yang memiliki otorisasi membuat dan mengunggah modul pembelajaran interaktif.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-[#243044] text-slate-700 dark:text-slate-200 font-semibold border border-slate-200 dark:border-[#2e3a4b]">
                        Total: {{ daftarGuru?.length ?? 0 }} Guru
                    </span>
                </div>
            </div>

            <!-- Box Import & Tambah Manual Guru -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-200 dark:border-[#2e3a4b] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <button type="button" @click="tab = 'excel'" :class="tab === 'excel' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-[#243044] text-slate-600 dark:text-slate-300'" class="px-3.5 py-2 rounded-xl text-xs font-semibold transition">
                            Import Data via Excel / CSV
                        </button>
                        <button type="button" @click="tab = 'manual'" :class="tab === 'manual' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-[#243044] text-slate-600 dark:text-slate-300'" class="px-3.5 py-2 rounded-xl text-xs font-semibold transition">
                            + Tambah Guru Baru
                        </button>
                    </div>
                    <span v-show="tab === 'excel'" class="text-xs text-slate-400 font-mono">Format kolom: Nama | NIK | Email | Password</span>
                </div>

                <!-- Form Import Excel Guru -->
                <div v-show="tab === 'excel'" class="p-5 bg-slate-50/50 dark:bg-[#1c2434]/40 border-b border-slate-200 dark:border-[#2e3a4b]">
                    <form @submit.prevent="submitExcel" class="flex flex-col sm:flex-row items-center gap-3">
                        <input type="file" @change="handleFileChange" accept=".xlsx,.csv,.txt" required
                            class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 dark:file:bg-brand-950 dark:file:text-brand-300 hover:file:bg-brand-100 cursor-pointer border border-slate-200 dark:border-[#2e3a4b] rounded-xl p-1.5 bg-white dark:bg-[#243044]" />
                        <button type="submit" :disabled="formExcel.processing" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs transition shadow-sm shrink-0 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                            <span>{{ formExcel.processing ? 'Mengunggah...' : 'Mulai Unggah Excel' }}</span>
                        </button>
                    </form>
                </div>

                <!-- Form Tambah Guru Manual -->
                <div v-show="tab === 'manual'" class="p-5 bg-slate-50/50 dark:bg-[#1c2434]/40 border-b border-slate-200 dark:border-[#2e3a4b]">
                    <form @submit.prevent="submitManual" class="space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap Guru</label>
                                <input v-model="formManual.nama" type="text" required placeholder="Contoh: Dra. Nurhayati, M.Pd" class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">NIK (Nomor Induk Kependudukan - Kredensial Login)</label>
                                <input v-model="formManual.nik" type="text" required placeholder="Contoh: 3201234567890001" class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs font-mono">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Alamat Email (Opsional)</label>
                                <input v-model="formManual.email" type="email" placeholder="Contoh: nurhayati@sekolah.sch.id" class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kata Sandi (Minimal 6 Karakter)</label>
                                <input v-model="formManual.kata_sandi" type="password" required placeholder="Masukkan kata sandi guru" class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                            </div>
                        </div>
                        <div class="flex justify-end pt-1">
                            <button type="submit" :disabled="formManual.processing" class="px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs transition shadow-sm">
                                {{ formManual.processing ? 'Menyimpan...' : 'Simpan Akun Guru' }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tabel Data Guru Lengkap -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="bg-slate-50/70 dark:bg-[#243044] text-slate-500 dark:text-slate-400 uppercase font-semibold text-[11px] border-b border-slate-200 dark:border-[#2e3a4b]">
                            <tr>
                                <th class="py-3.5 px-6">Nama Tenaga Pendidik</th>
                                <th class="py-3.5 px-6">NIK (Login)</th>
                                <th class="py-3.5 px-6">Email Terdaftar</th>
                                <th class="py-3.5 px-6">Waktu Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-[#2e3a4b]">
                            <tr v-for="g in daftarGuru" :key="g.id" class="hover:bg-slate-50/50 dark:hover:bg-[#243044]/40 transition">
                                <td class="py-3.5 px-6 font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-xs">
                                        {{ (g.name || 'G').charAt(0).toUpperCase() }}
                                    </div>
                                    <span>{{ g.name }}</span>
                                </td>
                                <td class="py-3.5 px-6 font-mono font-semibold text-brand-600 dark:text-brand-400">{{ g.nik }}</td>
                                <td class="py-3.5 px-6 text-slate-500">{{ g.email || '-' }}</td>
                                <td class="py-3.5 px-6 text-slate-400">{{ formatDate(g.created_at) }}</td>
                            </tr>
                            <tr v-if="!daftarGuru || daftarGuru.length === 0">
                                <td colspan="4" class="py-8 text-center text-slate-400">Belum ada akun guru yang terdaftar dalam sistem.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
