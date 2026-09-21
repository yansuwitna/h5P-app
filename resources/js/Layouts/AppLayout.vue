<script setup>
import { ref, onMounted } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const page = usePage();
const auth = page.props.auth || {};
const user = auth.user || {};
const role = auth.role || user.role || 'student';

const sidebarOpen = ref(false);
const sidebarExpanded = ref(true);
const dropdownOpen = ref(false);
const isDark = ref(false);

const roleBadge = role === 'admin' ? 'Administrator' : (role === 'teacher' ? 'Tenaga Pendidik' : 'Siswa Aktif');
const roleDot = role === 'admin' ? 'bg-rose-500' : (role === 'teacher' ? 'bg-indigo-500' : 'bg-emerald-500');

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

const logout = () => {
    router.post('/logout');
};

onMounted(() => {
    isDark.value = document.documentElement.classList.contains('dark');
});

const currentUrl = () => window.location.pathname;
const isUrl = (url) => window.location.pathname === url;
</script>

<template>
    <div class="antialiased text-slate-800 dark:text-slate-100 bg-[#f8fafc] dark:bg-[#0f172a] transition-colors duration-200 min-h-screen flex selection:bg-brand-500 selection:text-white font-sans overflow-x-hidden">
        
        <!-- Mobile Sidebar Backdrop -->
        <div v-if="sidebarOpen" 
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden transition-opacity">
        </div>

        <!-- Sidebar Kiri TailAdmin Theme -->
        <aside :class="[
            sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
            sidebarExpanded ? 'w-64' : 'w-20'
        ]" class="fixed top-0 left-0 z-50 flex h-screen flex-col bg-[#1c2434] text-slate-300 duration-300 ease-linear border-r border-[#2e3a4b] shadow-2xl lg:static lg:translate-x-0">
            
            <!-- Sidebar Header Brand -->
            <div class="flex items-center justify-between gap-2 px-5 py-5 lg:py-6 border-b border-[#2e3a4b]/80">
                <Link href="/" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-brand-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-brand-500/20">
                        ⚡
                    </div>
                    <div v-show="sidebarExpanded" class="leading-none">
                        <span class="text-base font-bold text-white tracking-tight">H5P<span class="text-brand-400">Class</span></span>
                        <span class="block text-[10px] text-slate-400 mt-1 uppercase font-semibold tracking-wider">TailAdmin LMS</span>
                    </div>
                </Link>

                <button @click="sidebarOpen = false" class="block lg:hidden text-slate-400 hover:text-white p-1 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Identitas Login User -->
            <div v-show="sidebarExpanded" class="px-5 py-4 border-b border-[#2e3a4b]/60 bg-[#161d2a]/50">
                <div class="text-[11px] uppercase font-bold text-slate-400 tracking-wider">Sesi Terhubung</div>
                <div class="text-sm font-semibold text-white truncate mt-0.5">{{ user?.name ?? 'Pengguna' }}</div>
                <div class="mt-1 flex items-center gap-1.5">
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[10px] font-semibold bg-[#243044] text-slate-200 border border-[#2e3a4b]">
                        <span class="w-1.5 h-1.5 rounded-full" :class="roleDot"></span>
                        {{ roleBadge }}
                    </span>
                </div>
            </div>

            <!-- Sidebar Navigation Links Area -->
            <div class="flex flex-col overflow-y-auto px-4 py-2 flex-1 space-y-6">
                <div>
                    <h3 class="mb-2.5 px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Menu Utama
                    </h3>

                    <ul class="space-y-1.5 text-xs font-medium">
                        <!-- MENU ADMIN -->
                        <template v-if="role === 'admin'">
                            <li>
                                <Link href="/admin" 
                                      :class="isUrl('/admin') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                                    <span>Dashboard Utama</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="/admin/guru" 
                                      :class="isUrl('/admin/guru') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg>
                                    <span>Data Guru</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="/admin/materi" 
                                      :class="isUrl('/admin/materi') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                                    <span>Modul H5P</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="/admin/siswa" 
                                      :class="isUrl('/admin/siswa') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-7.5 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                                    <span>Data Siswa</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="/admin/cms" 
                                      :class="isUrl('/admin/cms') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                    <span>CMS Landing Page</span>
                                </Link>
                            </li>
                        </template>

                        <!-- MENU GURU -->
                        <template v-else-if="role === 'teacher'">
                            <li>
                                <Link href="/guru" 
                                      :class="isUrl('/guru') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                                    <span>Dashboard Pendidik</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="/guru/siswa" 
                                      :class="isUrl('/guru/siswa') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-7.5 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                                    <span>Siswa Kelas</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="/guru/materi" 
                                      :class="isUrl('/guru/materi') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                                    <span>Modul Interaktif</span>
                                </Link>
                            </li>
                        </template>

                        <!-- MENU SISWA -->
                        <template v-else>
                            <li>
                                <Link href="/siswa" 
                                      :class="isUrl('/siswa') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                                    <span>Ruang Belajar</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="/siswa/materi" 
                                      :class="isUrl('/siswa/materi') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                                    <span>Katalog Materi</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="/siswa/rapor" 
                                      :class="isUrl('/siswa/rapor') ? 'bg-[#243044] !text-white font-semibold shadow-sm' : ''"
                                      class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-medium text-slate-300 hover:bg-[#243044] hover:text-white transition duration-200">
                                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.003 0H8.997m5.003 0c.23-.396.375-.855.375-1.348 0-1.519-1.231-2.75-2.75-2.75s-2.75 1.231-2.75 2.75c0 .493.145.952.375 1.348m6.75-6.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" /></svg>
                                    <span>Rapor & Lencana</span>
                                </Link>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>

            <!-- Sidebar Footer Quick Link -->
            <div class="p-4 border-t border-[#2e3a4b]/80">
                <Link href="/" class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs text-slate-400 hover:bg-[#243044] hover:text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span v-show="sidebarExpanded">Halaman Depan</span>
                </Link>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden min-h-screen">
            
            <!-- TailAdmin Top Header Bar -->
            <header class="sticky top-0 z-30 flex w-full bg-white dark:bg-[#1c2434] border-b border-slate-200 dark:border-[#2e3a4b] shadow-sm">
                <div class="flex flex-grow items-center justify-between py-3.5 px-4 md:px-6 2xl:px-11">
                    
                    <!-- Sisi Kiri: Hamburger Mobile -->
                    <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
                        <button @click="sidebarOpen = !sidebarOpen" class="z-30 block rounded-lg border border-slate-200 dark:border-[#2e3a4b] bg-white dark:bg-[#243044] p-1.5 shadow-sm">
                            <svg class="w-5 h-5 text-slate-600 dark:text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>

                    <!-- Breadcrumb / Slogan -->
                    <div class="hidden sm:block">
                        <h2 class="text-sm font-bold text-slate-800 dark:text-white flex items-center gap-2">
                            <span>Sistem LMS Interaktif H5P</span>
                            <span class="text-xs font-normal text-slate-400">/ Generasi Masa Depan</span>
                        </h2>
                    </div>

                    <!-- Sisi Kanan: Dark Mode & Dropdown User -->
                    <div class="flex items-center gap-3 2xl:gap-7">
                        <!-- Dark Mode Switcher -->
                        <button @click="toggleTheme" type="button" class="relative flex h-8.5 w-8.5 items-center justify-center rounded-full border border-slate-200 dark:border-[#2e3a4b] bg-slate-100 dark:bg-[#243044] hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 transition" title="Ganti Mode Gelap/Terang">
                            <span v-if="!isDark">🌙</span>
                            <span v-else>☀️</span>
                        </button>

                        <!-- User Profile Dropdown -->
                        <div class="relative">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-brand-600 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                                    {{ (user?.name || 'A').charAt(0).toUpperCase() }}
                                </div>
                                <div class="hidden text-left sm:block">
                                    <span class="block text-xs font-bold text-slate-900 dark:text-white">{{ user?.name ?? 'Akun' }}</span>
                                    <span class="block text-[10px] text-slate-400">{{ roleBadge }}</span>
                                </div>
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div v-show="dropdownOpen" @click.outside="dropdownOpen = false" class="absolute right-0 mt-3 w-56 rounded-2xl border border-slate-200 dark:border-[#2e3a4b] bg-white dark:bg-[#1c2434] p-2 shadow-xl z-50 text-xs">
                                <div class="p-3 border-b border-slate-100 dark:border-[#2e3a4b]">
                                    <p class="font-bold text-slate-900 dark:text-white truncate">{{ user?.name }}</p>
                                    <p class="text-[11px] text-slate-400 font-mono truncate">{{ user?.email ?? (user?.nik ?? user?.nisn) }}</p>
                                </div>
                                <div class="py-1">
                                    <Link href="/profil" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-[#243044]">
                                        <span>⚙️</span> Pengaturan Profil
                                    </Link>
                                </div>
                                <div class="pt-1 border-t border-slate-100 dark:border-[#2e3a4b]">
                                    <button @click="logout" class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 font-semibold text-left">
                                        <span>🚪</span> Keluar Sesi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Page Content -->
            <main class="p-4 sm:p-6 lg:p-8 flex-1">
                <!-- Flash Notification Banner -->
                <div v-if="$page.props.flash?.sukses" class="mb-5 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-xs text-emerald-800 dark:text-emerald-200 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span>✅</span>
                        <span>{{ $page.props.flash.sukses }}</span>
                    </div>
                </div>
                <div v-if="$page.props.flash?.error" class="mb-5 p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-xs text-rose-800 dark:text-rose-200 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span>⚠️</span>
                        <span>{{ $page.props.flash.error }}</span>
                    </div>
                </div>

                <slot />
            </main>

            <!-- Footer App -->
            <footer class="p-4 sm:p-6 text-center text-xs text-slate-400 dark:text-slate-500 border-t border-slate-200 dark:border-[#2e3a4b] bg-white dark:bg-[#1c2434]">
                &copy; {{ new Date().getFullYear() }} H5P Class LMS &bull; Standar TailAdmin Modern UI
            </footer>
        </div>
    </div>
</template>
