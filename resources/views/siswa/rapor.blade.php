<x-app-layout>
    <div class="space-y-6">

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#1c2434] p-5 sm:p-6 rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm">
            <div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 text-xs font-semibold mb-1">
                    <span>Prestasi & Capaian</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                    Rapor Capaian & Lencana Prestasi
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    Riwayat pengerjaan modul pembelajaran dan perolehan skor interaktif Anda.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-[#243044] text-slate-700 dark:text-slate-200 font-semibold border border-slate-200 dark:border-[#2e3a4b]">
                    {{ count($nilai) }} Kuis Diselesaikan
                </span>
            </div>
        </div>

        <!-- Panduan Kategori Lencana -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-5 rounded-2xl bg-white dark:bg-[#1c2434] border border-slate-200 dark:border-[#2e3a4b] flex items-center gap-3">
                <span class="text-3xl">🥇</span>
                <div>
                    <h4 class="font-bold text-sm text-slate-900 dark:text-white">Lencana Emas</h4>
                    <p class="text-xs text-slate-400">Skor capaian minimal 90% ke atas</p>
                </div>
            </div>
            <div class="p-5 rounded-2xl bg-white dark:bg-[#1c2434] border border-slate-200 dark:border-[#2e3a4b] flex items-center gap-3">
                <span class="text-3xl">🥈</span>
                <div>
                    <h4 class="font-bold text-sm text-slate-900 dark:text-white">Lencana Perak</h4>
                    <p class="text-xs text-slate-400">Skor capaian antara 75% hingga 89%</p>
                </div>
            </div>
            <div class="p-5 rounded-2xl bg-white dark:bg-[#1c2434] border border-slate-200 dark:border-[#2e3a4b] flex items-center gap-3">
                <span class="text-3xl">🥉</span>
                <div>
                    <h4 class="font-bold text-sm text-slate-900 dark:text-white">Lencana Perunggu</h4>
                    <p class="text-xs text-slate-400">Skor capaian di bawah 75%</p>
                </div>
            </div>
        </div>

        <!-- Tabel Riwayat Skor -->
        <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-200 dark:border-[#2e3a4b]">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white">Riwayat Pengerjaan Kuis Interaktif</h3>
                <p class="text-xs text-slate-400">Catatan otomatis saat Anda menyelesaikan modul H5P</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead class="bg-slate-50/70 dark:bg-[#243044] text-slate-500 dark:text-slate-400 uppercase font-semibold text-[11px] border-b border-slate-200 dark:border-[#2e3a4b]">
                        <tr>
                            <th class="py-3.5 px-6">Modul Pelajaran</th>
                            <th class="py-3.5 px-6">Skor Diperoleh</th>
                            <th class="py-3.5 px-6">Persentase</th>
                            <th class="py-3.5 px-6">Lencana Prestasi</th>
                            <th class="py-3.5 px-6">Waktu Pengerjaan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-[#2e3a4b]">
                        @forelse($nilai as $n)
                            @php
                                $persen = round(($n->skor / max($n->skor_maksimal, 1)) * 100);
                            @endphp
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-[#243044]/40 transition">
                                <td class="py-3.5 px-6 font-semibold text-slate-900 dark:text-white">{{ $n->materi->judul ?? 'Modul H5P' }}</td>
                                <td class="py-3.5 px-6 font-mono font-bold text-slate-800 dark:text-slate-200">{{ $n->skor }} / {{ $n->skor_maksimal }}</td>
                                <td class="py-3.5 px-6 font-bold {{ $persen >= 90 ? 'text-amber-600' : ($persen >= 75 ? 'text-brand-600' : 'text-orange-600') }}">
                                    {{ $persen }}%
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold {{ $n->lencana === 'Emas' ? 'bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200' : ($n->lencana === 'Perak' ? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300' : 'bg-orange-50 text-orange-700 dark:bg-orange-950/60 dark:text-orange-300') }}">
                                        <span>{{ $n->lencana === 'Emas' ? '🥇' : ($n->lencana === 'Perak' ? '🥈' : '🥉') }}</span>
                                        <span>{{ $n->lencana }}</span>
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-slate-400">{{ $n->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400">Belum ada riwayat pengerjaan modul kuis interaktif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
