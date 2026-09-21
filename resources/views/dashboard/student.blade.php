<x-app-layout>
    <div class="space-y-6">

            <!-- 1. Banner Sambutan Siswa & Progress Belajar Cepat -->
            <div class="bg-gradient-to-r from-indigo-600 via-indigo-700 to-slate-900 rounded-2xl p-6 sm:p-7 text-white shadow-lg relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                
                @php
                    $totalTugas = count($materi);
                    $selesai = $nilai->count();
                    $persenSelesai = $totalTugas > 0 ? round(($selesai / $totalTugas) * 100) : 0;
                @endphp

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold text-indigo-100 border border-white/20">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Ruang Belajar Siswa Mandiri</span>
                            <span>&bull;</span>
                            <span class="font-mono">{{ Auth::user()->nisn ?? 'Siswa' }}</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
                            Selamat Belajar, {{ Auth::user()->name }}! 👋
                        </h1>
                        <p class="text-indigo-100 text-xs sm:text-sm leading-relaxed max-w-xl">
                            Semua modul pelajaran interaktif H5P Anda langsung tersedia di bawah. Klik tombol untuk memulai pengerjaan kuis dan raih medali prestasi!
                        </p>
                    </div>

                    <!-- Progress Ringkas & Medali -->
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-4 shrink-0 flex items-center gap-4">
                        <div class="text-center pr-3 border-r border-white/20">
                            <span class="text-[10px] uppercase font-bold text-indigo-200 block">Progres</span>
                            <span class="text-xl font-bold font-mono">{{ $selesai }}/{{ $totalTugas }}</span>
                            <span class="text-[10px] text-emerald-300 block font-semibold">{{ $persenSelesai }}% Selesai</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-center">
                            <div class="px-2 py-1 bg-black/20 rounded-lg">
                                <span class="text-base block">🥇</span>
                                <span class="text-[10px] font-bold">{{ $nilai->where('lencana', 'Emas')->count() }}</span>
                            </div>
                            <div class="px-2 py-1 bg-black/20 rounded-lg">
                                <span class="text-base block">🥈</span>
                                <span class="text-[10px] font-bold">{{ $nilai->where('lencana', 'Perak')->count() }}</span>
                            </div>
                            <div class="px-2 py-1 bg-black/20 rounded-lg">
                                <span class="text-base block">🥉</span>
                                <span class="text-[10px] font-bold">{{ $nilai->where('lencana', 'Perunggu')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Utama: 2 Kolom Seimbang -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- Sisi Kiri: Katalog Modul (7 Kolom) -->
                <div id="katalog-materi" class="lg:col-span-7 space-y-4">
                    <div class="flex items-center justify-between pb-1">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white">Modul Pembelajaran</h2>
                            <p class="text-xs text-slate-500">Pilih modul yang ditugaskan oleh guru</p>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">
                            {{ count($materi) }} Materi Tersedia
                        </span>
                    </div>

                    <div class="space-y-3">
                        @forelse($materi as $m)
                            @php
                                $skorSiswa = $nilai->where('materi_id', $m->id)->first();
                            @endphp
                            <div class="bg-white dark:bg-slate-900 rounded-xl p-5 border border-slate-200 dark:border-slate-800 hover:border-indigo-300 dark:hover:border-indigo-800 shadow-sm transition flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                
                                <div class="flex items-start gap-3.5">
                                    <div class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-100 dark:border-indigo-900/60 flex items-center justify-center text-indigo-600 dark:text-indigo-400 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h3 class="font-semibold text-slate-900 dark:text-white text-sm">
                                                {{ $m->judul }}
                                            </h3>
                                            @if($skorSiswa)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold {{ $skorSiswa->lencana === 'Emas' ? 'bg-amber-50 text-amber-700 dark:bg-amber-950/50 dark:text-amber-300 border border-amber-200 dark:border-amber-800' : ($skorSiswa->lencana === 'Perak' ? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 border border-slate-300' : 'bg-orange-50 text-orange-700 dark:bg-orange-950/50 dark:text-orange-300 border border-orange-200') }}">
                                                    Lencana {{ $skorSiswa->lencana }} &bull; {{ $skorSiswa->skor }}/{{ $skorSiswa->skor_maksimal }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-3 text-xs text-slate-400">
                                            <span>Pengampu: <strong class="text-slate-600 dark:text-slate-300">{{ $m->guru->name }}</strong></span>
                                            <span>&bull;</span>
                                            <span>{{ $m->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('materi.kerjakan', $m->id) }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg text-xs font-semibold transition shrink-0 {{ $skorSiswa ? 'bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200' : 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm' }}">
                                    <span>{{ $skorSiswa ? 'Ulangi Kuis' : 'Mulai Kerjakan' }}</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                </a>

                            </div>
                        @empty
                            <div class="bg-white dark:bg-slate-900 rounded-xl p-8 border border-slate-200 dark:border-slate-800 text-center text-slate-400">
                                <p class="text-sm font-medium">Belum ada modul yang tersedia saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Sisi Kanan: Rekap Rapor Siswa (5 Kolom) -->
                <div id="rapor-nilai" class="lg:col-span-5 bg-white dark:bg-slate-900 rounded-xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                    <div class="border-b border-slate-100 dark:border-slate-800 pb-3">
                        <h2 class="text-base font-bold text-slate-900 dark:text-white">Rapor Capaian Nilai</h2>
                        <p class="text-xs text-slate-400">Riwayat skor modul interaktif yang telah diselesaikan</p>
                    </div>

                    <!-- Panduan Standar Nilai -->
                    <div class="grid grid-cols-3 gap-2 text-center text-xs">
                        <div class="p-2 rounded-lg bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800">
                            <span class="text-[10px] font-bold text-amber-600 dark:text-amber-400 uppercase block">Emas</span>
                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">&ge; 90%</span>
                        </div>
                        <div class="p-2 rounded-lg bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800">
                            <span class="text-[10px] font-bold text-slate-600 dark:text-slate-300 uppercase block">Perak</span>
                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">&ge; 75%</span>
                        </div>
                        <div class="p-2 rounded-lg bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800">
                            <span class="text-[10px] font-bold text-orange-600 dark:text-orange-400 uppercase block">Perunggu</span>
                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">&lt; 75%</span>
                        </div>
                    </div>

                    <!-- Daftar Riwayat -->
                    <div class="space-y-2.5 max-h-96 overflow-y-auto pr-1">
                        @forelse($nilai as $n)
                            @php
                                $persen = round(($n->skor / max($n->skor_maksimal, 1)) * 100);
                            @endphp
                            <div class="p-3.5 rounded-lg bg-slate-50/70 dark:bg-slate-950/40 border border-slate-200/70 dark:border-slate-800 space-y-2">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-semibold text-slate-800 dark:text-slate-200 line-clamp-1 max-w-[200px]">{{ $n->materi->judul }}</span>
                                    <span class="font-bold {{ $persen >= 90 ? 'text-amber-600' : ($persen >= 75 ? 'text-indigo-600' : 'text-orange-600') }}">{{ $n->skor }}/{{ $n->skor_maksimal }} ({{ $persen }}%)</span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full {{ $persen >= 90 ? 'bg-amber-500' : ($persen >= 75 ? 'bg-indigo-600' : 'bg-orange-500') }}" style="width: {{ $persen }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="py-8 text-center text-slate-400 text-xs">
                                Belum ada riwayat kuis yang dikerjakan.
                            </div>
                        @endforelse
                    </div>
                </div>

    </div>
</x-app-layout>
