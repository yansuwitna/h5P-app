<x-app-layout>
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
                        Kelola data guru, data siswa, katalog materi interaktif H5P, dan atur kustomisasi halaman depan sekolah.
                    </p>
                </div>

                <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-4 shrink-0 text-center">
                    <div class="text-[11px] text-slate-300 uppercase font-bold tracking-wider">Akun Login Aktif</div>
                    <div class="text-lg font-bold text-white mt-0.5 font-mono">{{ Auth::user()->username ?? 'admin' }}</div>
                    <div class="text-[10px] text-emerald-400 font-semibold mt-0.5">Otoritas Penuh</div>
                </div>
            </div>
        </div>

        <!-- Stats Metric Cards (TailAdmin Standard) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Guru</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-1 font-mono">{{ $totalGuru }}</h3>
                    <p class="text-xs text-brand-600 dark:text-brand-400 mt-1 font-medium">Tenaga Pendidik Aktif</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl">
                    👨‍🏫
                </div>
            </div>

            <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Siswa</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-1 font-mono">{{ $totalSiswa }}</h3>
                    <p class="text-xs text-blue-600 dark:text-blue-400 mt-1 font-medium">Peserta Didik Terdaftar</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl">
                    🎒
                </div>
            </div>

            <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Modul H5P</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-1 font-mono">{{ $totalMateri }}</h3>
                    <p class="text-xs text-purple-600 dark:text-purple-400 mt-1 font-medium">Materi Interaktif Terbit</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl">
                    ⚡
                </div>
            </div>
        </div>

        <!-- Ringkasan Cepat & Akses Menu -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Ringkasan Guru Terbaru -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="p-5 border-b border-slate-200 dark:border-[#2e3a4b] flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span>👨‍🏫</span> Guru Terdaftar Terbaru
                            </h3>
                            <p class="text-xs text-slate-400">Daftar tenaga pendidik yang baru ditambahkan</p>
                        </div>
                        <a href="{{ route('admin.guru') }}" class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">
                            Lihat Semua Guru &rarr;
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50/70 dark:bg-[#243044] text-slate-400 uppercase font-semibold text-[11px] border-b border-slate-200 dark:border-[#2e3a4b]">
                                <tr>
                                    <th class="py-3 px-5">Nama Guru</th>
                                    <th class="py-3 px-5">NIK (Login)</th>
                                    <th class="py-3 px-5">Email</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-[#2e3a4b]">
                                @forelse($daftarGuru as $g)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#243044]/40 transition">
                                        <td class="py-3.5 px-5 font-semibold text-slate-900 dark:text-white">{{ $g->name }}</td>
                                        <td class="py-3.5 px-5 font-mono font-semibold text-brand-600 dark:text-brand-400">{{ $g->nik }}</td>
                                        <td class="py-3.5 px-5 text-slate-500">{{ $g->email ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="py-6 text-center text-slate-400">Belum ada guru terdaftar.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-4 bg-slate-50/60 dark:bg-[#1c2434] border-t border-slate-200 dark:border-[#2e3a4b] text-right">
                    <a href="{{ route('admin.guru') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold transition">
                        <span>Kelola & Import Guru</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>
            </div>

            <!-- Ringkasan Siswa Terbaru -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="p-5 border-b border-slate-200 dark:border-[#2e3a4b] flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span>🎒</span> Siswa Terdaftar Terbaru
                            </h3>
                            <p class="text-xs text-slate-400">Daftar peserta didik yang baru didaftarkan</p>
                        </div>
                        <a href="{{ route('admin.siswa') }}" class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">
                            Lihat Semua Siswa &rarr;
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50/70 dark:bg-[#243044] text-slate-400 uppercase font-semibold text-[11px] border-b border-slate-200 dark:border-[#2e3a4b]">
                                <tr>
                                    <th class="py-3 px-5">Nama Siswa</th>
                                    <th class="py-3 px-5">NISN (Login)</th>
                                    <th class="py-3 px-5">Terdaftar</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-[#2e3a4b]">
                                @forelse($daftarSiswa as $s)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#243044]/40 transition">
                                        <td class="py-3.5 px-5 font-semibold text-slate-900 dark:text-white">{{ $s->name }}</td>
                                        <td class="py-3.5 px-5 font-mono font-semibold text-blue-600 dark:text-blue-400">{{ $s->nisn }}</td>
                                        <td class="py-3.5 px-5 text-slate-500">{{ $s->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="py-6 text-center text-slate-400">Belum ada siswa terdaftar.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-4 bg-slate-50/60 dark:bg-[#1c2434] border-t border-slate-200 dark:border-[#2e3a4b] text-right">
                    <a href="{{ route('admin.siswa') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold transition">
                        <span>Kelola & Import Siswa</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
