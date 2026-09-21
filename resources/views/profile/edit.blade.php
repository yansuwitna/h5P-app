<x-app-layout>
    <div class="space-y-6">

        <!-- Header Halaman Profil -->
        <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-brand-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-brand-50 dark:bg-brand-950/60 text-[11px] font-semibold text-brand-700 dark:text-brand-300 border border-brand-200 dark:border-brand-800 mb-1">
                        <span>Akun Terverifikasi</span>
                    </div>
                    <h1 class="text-xl font-bold text-slate-900 dark:text-white">
                        {{ Auth::user()->name }}
                    </h1>
                    <p class="text-xs text-slate-500 font-mono">
                        {{ Auth::user()->email ?? (Auth::user()->nik ?? (Auth::user()->nisn ?? 'Kredensial Aktif')) }}
                    </p>
                </div>
            </div>

            <a href="{{ route('beranda') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-[#243044] dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold transition self-start sm:self-auto border border-slate-200 dark:border-[#2e3a4b]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>

        <!-- Form Edit Profil & Keamanan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Data Informasi Pengguna -->
            <div class="p-6 sm:p-7 bg-white dark:bg-[#1c2434] border border-slate-200 dark:border-[#2e3a4b] shadow-sm rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Keamanan & Kata Sandi -->
            <div class="p-6 sm:p-7 bg-white dark:bg-[#1c2434] border border-slate-200 dark:border-[#2e3a4b] shadow-sm rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Opsi Hapus Akun (Hanya Jika Diperlukan) -->
        <div class="p-6 sm:p-7 bg-white dark:bg-[#1c2434] border border-slate-200 dark:border-[#2e3a4b] shadow-sm rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</x-app-layout>
