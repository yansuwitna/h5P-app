<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    user: Object,
    status: String,
});

const formInfo = useForm({
    name: props.user?.name || '',
    email: props.user?.email || '',
});

const formPassword = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updateProfile = () => {
    formInfo.patch('/profil', {
        preserveScroll: true,
    });
};

const updatePassword = () => {
    formPassword.put('/password', {
        preserveScroll: true,
        onSuccess: () => formPassword.reset(),
    });
};
</script>

<template>
    <AppLayout>
        <Head title="Pengaturan Profil" />

        <div class="space-y-6">
            <!-- Header Halaman Profil -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        {{ (user?.name || 'A').charAt(0).toUpperCase() }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-brand-50 dark:bg-brand-950/60 text-[11px] font-semibold text-brand-700 dark:text-brand-300 border border-brand-200 dark:border-brand-800 mb-1">
                            <span>Akun Terverifikasi</span>
                        </div>
                        <h1 class="text-xl font-bold text-slate-900 dark:text-white">
                            {{ user?.name }}
                        </h1>
                        <p class="text-xs text-slate-500 font-mono">
                            {{ user?.email || (user?.nik || (user?.nisn || user?.username)) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Edit Profil & Keamanan -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Data Informasi Pengguna -->
                <div class="p-6 sm:p-7 bg-white dark:bg-[#1c2434] border border-slate-200 dark:border-[#2e3a4b] shadow-sm rounded-2xl space-y-4">
                    <div class="border-b border-slate-100 dark:border-[#2e3a4b] pb-3">
                        <h2 class="text-base font-bold text-slate-900 dark:text-white">Informasi Akun</h2>
                        <p class="text-xs text-slate-400">Perbarui nama lengkap dan alamat email Anda</p>
                    </div>

                    <form @submit.prevent="updateProfile" class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap</label>
                            <input v-model="formInfo.name" type="text" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                            <input v-model="formInfo.email" type="email" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" :disabled="formInfo.processing" class="px-5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs transition">
                                Simpan Profil
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Keamanan & Kata Sandi -->
                <div class="p-6 sm:p-7 bg-white dark:bg-[#1c2434] border border-slate-200 dark:border-[#2e3a4b] shadow-sm rounded-2xl space-y-4">
                    <div class="border-b border-slate-100 dark:border-[#2e3a4b] pb-3">
                        <h2 class="text-base font-bold text-slate-900 dark:text-white">Ubah Kata Sandi</h2>
                        <p class="text-xs text-slate-400">Pastikan akun menggunakan kata sandi yang aman</p>
                    </div>

                    <form @submit.prevent="updatePassword" class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kata Sandi Saat Ini</label>
                            <input v-model="formPassword.current_password" type="password" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kata Sandi Baru</label>
                            <input v-model="formPassword.password" type="password" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Konfirmasi Kata Sandi Baru</label>
                            <input v-model="formPassword.password_confirmation" type="password" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" :disabled="formPassword.processing" class="px-5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs transition">
                                Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
