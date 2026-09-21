<script setup>
import { ref } from 'vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

defineProps({
    status: String,
    errors: Object,
});

const isDark = ref(false);

const form = useForm({
    login: '',
    password: '',
    remember: false,
});

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

const submit = () => {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="font-sans text-slate-800 dark:text-slate-100 antialiased bg-slate-50 dark:bg-[#090d16] bg-grid-pattern selection:bg-indigo-500 selection:text-white transition-colors duration-200 min-h-screen flex flex-col justify-between">
        <Head title="Masuk Portal Terpadu" />

        <!-- Top Header Bar with Home Backlink & Dark/Light Mode Switcher -->
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <Link href="/" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Kembali ke Beranda</span>
            </Link>

            <button @click="toggleTheme" type="button" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 text-xs font-medium hover:bg-slate-50 dark:hover:bg-slate-800/80 transition shadow-sm">
                <span>{{ isDark ? '☀️ Mode Terang' : '🌙 Mode Gelap' }}</span>
            </button>
        </div>

        <div class="flex-1 flex items-center justify-center p-4 sm:p-6">
            <div class="w-full max-w-[420px]">
                <!-- Logo & Heading -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-indigo-600 text-white shadow-sm mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">Portal Masuk Terpadu</h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 font-normal">Satu akses untuk Administrator, Guru, dan Siswa</p>
                </div>

                <!-- Login Card -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 sm:p-7 shadow-sm">
                    <!-- Status Flash Message -->
                    <div v-if="status" class="mb-4 text-xs font-medium text-emerald-600">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit" class="space-y-4">
                        <!-- Identifier Input -->
                        <div>
                            <label for="login" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                                Username / NIK / NISN
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                                <input id="login" v-model="form.login" type="text" required autofocus
                                    placeholder="Masukkan Username, NIK, atau NISN"
                                    class="block w-full pl-9 pr-3.5 py-2 rounded-lg bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 text-xs focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 transition" />
                            </div>
                            <p v-if="form.errors.login" class="mt-1.5 text-rose-500 text-xs font-medium">{{ form.errors.login }}</p>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                                Kata Sandi
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                </div>
                                <input id="password" v-model="form.password" type="password" required autocomplete="current-password"
                                    placeholder="••••••••"
                                    class="block w-full pl-9 pr-3.5 py-2 rounded-lg bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 text-xs focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 transition" />
                            </div>
                            <p v-if="form.errors.password" class="mt-1.5 text-rose-500 text-xs font-medium">{{ form.errors.password }}</p>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between pt-0.5">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                <input id="remember_me" v-model="form.remember" type="checkbox" class="w-3.5 h-3.5 rounded border-slate-300 dark:border-slate-700 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 bg-white dark:bg-slate-900">
                                <span class="ms-2 text-xs text-slate-500 dark:text-slate-400">Ingat sesi saya</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" :disabled="form.processing" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-sm transition text-xs flex items-center justify-center gap-2">
                            <span>{{ form.processing ? 'Memproses...' : 'Masuk ke Akun' }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Footer Meta -->
                <p class="text-center text-[11px] text-slate-400 dark:text-slate-600 mt-5">
                    &copy; {{ new Date().getFullYear() }} LMS H5P Interaktif &bull; Sistem Terdistribusi Standar Industri
                </p>
            </div>
        </div>
    </div>
</template>
