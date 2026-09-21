<x-app-layout>
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
                    <span class="text-2xl font-bold text-slate-900 dark:text-white mt-1 block font-mono">{{ count($siswa) }}</span>
                    <span class="text-xs text-brand-600 dark:text-brand-400 mt-0.5 block font-medium">Peserta Didik Aktif</span>
                </div>
                <div class="p-5 rounded-2xl bg-slate-50/70 dark:bg-[#243044]/60 border border-slate-200 dark:border-[#2e3a4b]">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Modul Diterbitkan</span>
                    <span class="text-2xl font-bold text-slate-900 dark:text-white mt-1 block font-mono">{{ count($materi) }}</span>
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
                    <a href="{{ route('guru.siswa') }}" class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="space-y-2 max-h-72 overflow-y-auto pr-1">
                    @forelse($siswa->take(6) as $s)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-[#243044]/50 border border-slate-200/60 dark:border-[#2e3a4b] text-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 rounded-lg bg-indigo-50 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper(substr($s->name, 0, 1)) }}
                                </div>
                                <span class="font-medium text-slate-800 dark:text-slate-200">{{ $s->name }}</span>
                            </div>
                            <span class="font-mono text-slate-500 text-xs bg-white dark:bg-[#1c2434] px-2.5 py-1 rounded-lg border border-slate-200 dark:border-[#2e3a4b]">NISN: {{ $s->nisn }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic text-center py-6">Belum ada data siswa terdaftar dari Administrator.</p>
                    @endforelse
                </div>

                <div class="pt-2 text-right">
                    <a href="{{ route('guru.siswa') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold transition shadow-sm">
                        <span>Buka Halaman Siswa Kelas</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>
            </div>

            <!-- Ringkasan Modul Terbit -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm space-y-4">
                <div class="border-b border-slate-100 dark:border-[#2e3a4b] pb-3 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 dark:text-white">Modul Pembelajaran Terbit</h2>
                        <p class="text-xs text-slate-400">Materi yang telah Anda unggah</p>
                    </div>
                    <a href="{{ route('guru.materi') }}" class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">
                        Kelola & Unggah &rarr;
                    </a>
                </div>

                <div class="space-y-2 max-h-72 overflow-y-auto pr-1">
                    @forelse($materi->take(6) as $m)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-[#243044]/50 border border-slate-200/60 dark:border-[#2e3a4b] text-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 rounded-lg bg-brand-50 dark:bg-brand-950 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-xs">
                                    H5P
                                </div>
                                <span class="font-medium text-slate-800 dark:text-slate-200 truncate max-w-[200px]">{{ $m->judul }}</span>
                            </div>
                            <a href="{{ route('materi.kerjakan', $m->id) }}" target="_blank" class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">
                                Pratinjau &rarr;
                            </a>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic text-center py-6">Belum ada modul yang diunggah.</p>
                    @endforelse
                </div>

                <div class="pt-2 text-right">
                    <a href="{{ route('guru.materi') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold transition shadow-sm">
                        <span>Unggah Modul Baru</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    </a>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
