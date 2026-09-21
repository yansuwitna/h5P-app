<x-app-layout>
    <div class="space-y-6">

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#1c2434] p-5 sm:p-6 rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm">
            <div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-brand-50 dark:bg-brand-950/60 text-brand-600 dark:text-brand-400 text-xs font-semibold mb-1">
                    <span>Katalog Pembelajaran</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                    Daftar Materi Interaktif H5P
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    Pilih modul pembelajaran di bawah ini untuk memulai latihan mandiri dan mendapatkan lencana prestasi.
                </p>
            </div>
            <span class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-[#243044] text-slate-700 dark:text-slate-200 font-semibold border border-slate-200 dark:border-[#2e3a4b] self-start sm:self-auto">
                {{ count($materi) }} Materi Tersedia
            </span>
        </div>

        <!-- Grid Katalog Materi -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($materi as $m)
                @php
                    $skorSiswa = $nilai->where('materi_id', $m->id)->first();
                @endphp
                <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-5 border border-slate-200 dark:border-[#2e3a4b] hover:border-brand-500 transition-all shadow-sm flex flex-col justify-between gap-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="w-9 h-9 rounded-xl bg-brand-50 dark:bg-brand-950/60 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-xs border border-brand-200 dark:border-brand-900/60">
                                H5P
                            </span>
                            @if($skorSiswa)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold {{ $skorSiswa->lencana === 'Emas' ? 'bg-amber-50 text-amber-700 dark:bg-amber-950/50 dark:text-amber-300 border border-amber-200' : ($skorSiswa->lencana === 'Perak' ? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300' : 'bg-orange-50 text-orange-700 dark:bg-orange-950/50 dark:text-orange-300') }}">
                                    Lencana {{ $skorSiswa->lencana }} &bull; {{ $skorSiswa->skor }}/{{ $skorSiswa->skor_maksimal }}
                                </span>
                            @else
                                <span class="text-[11px] text-slate-400">Belum dikerjakan</span>
                            @endif
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-900 dark:text-white text-sm line-clamp-2">
                                {{ $m->judul }}
                            </h3>
                            <p class="text-xs text-slate-400 mt-1">
                                Guru Pengampu: <strong class="text-slate-700 dark:text-slate-300">{{ $m->guru->name ?? 'Tenaga Pendidik' }}</strong>
                            </p>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-slate-100 dark:border-[#2e3a4b] flex items-center justify-between">
                        <span class="text-[11px] text-slate-400">{{ $m->created_at->format('d M Y') }}</span>
                        <a href="{{ route('materi.kerjakan', $m->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold transition {{ $skorSiswa ? 'bg-slate-100 hover:bg-slate-200 dark:bg-[#243044] dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200' : 'bg-brand-600 hover:bg-brand-700 text-white shadow-sm' }}">
                            <span>{{ $skorSiswa ? 'Ulangi Kuis' : 'Mulai Belajar' }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white dark:bg-[#1c2434] rounded-2xl p-12 text-center text-slate-400 border border-slate-200 dark:border-[#2e3a4b]">
                    Belum ada materi pembelajaran yang tersedia saat ini.
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
