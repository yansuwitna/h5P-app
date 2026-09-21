<x-app-layout>
    <div class="space-y-6">

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#1c2434] p-5 sm:p-6 rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm">
            <div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 text-xs font-semibold mb-1">
                    <span>Modul Interaktif</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                    Katalog & Unggah Modul H5P
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    Unggah paket materi kuis interaktif baru atau tinjau modul pembelajaran yang telah diterbitkan.
                </p>
            </div>
            <span class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-[#243044] text-slate-700 dark:text-slate-200 font-semibold border border-slate-200 dark:border-[#2e3a4b] self-start sm:self-auto">
                Total: {{ count($materi) }} Modul Terbit
            </span>
        </div>

        <!-- Form Unggah Modul -->
        <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 border border-slate-200 dark:border-[#2e3a4b] shadow-sm space-y-4">
            <div class="border-b border-slate-100 dark:border-[#2e3a4b] pb-3">
                <h2 class="text-base font-bold text-slate-900 dark:text-white">Unggah Paket Modul H5P Baru</h2>
                <p class="text-xs text-slate-400">Pilih berkas paket kuis/materi interaktif berekstensi .h5p atau .zip</p>
            </div>

            <form action="{{ route('materi.unggah') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Judul Materi Pembelajaran</label>
                    <input type="text" name="judul" required placeholder="Contoh: Kuis Interaktif Sistem Peredaran Darah Manusia"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-slate-800 dark:text-slate-200 text-xs focus:ring-1 focus:ring-brand-500 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Berkas Modul (.h5p / .zip)</label>
                    <label for="file_h5p_input_dedicated" class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-2xl cursor-pointer bg-slate-50/50 dark:bg-[#243044]/40 hover:bg-slate-50 dark:hover:bg-[#243044] transition">
                        <div class="flex flex-col items-center justify-center p-4 text-center">
                            <svg class="w-8 h-8 text-slate-400 mb-2" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" /></svg>
                            <p class="text-xs font-semibold text-slate-700 dark:text-slate-300" id="file-chosen-dedicated">Pilih berkas .h5p dari komputer Anda</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">Mendukung ekspor dari Lumi Education, Canva, maupun H5P.org</p>
                        </div>
                        <input id="file_h5p_input_dedicated" type="file" name="file_h5p" accept=".h5p,.zip" class="hidden" required onchange="document.getElementById('file-chosen-dedicated').innerText = this.files[0] ? this.files[0].name : 'Pilih berkas .h5p dari komputer Anda';" />
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs transition shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                        <span>Unggah & Ekstrak Modul H5P</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Modul -->
        <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-200 dark:border-[#2e3a4b] flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Daftar Modul yang Diterbitkan</h3>
                    <p class="text-xs text-slate-400">Seluruh materi yang dapat dikerjakan secara mandiri oleh siswa</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead class="bg-slate-50/70 dark:bg-[#243044] text-slate-500 dark:text-slate-400 uppercase font-semibold text-[11px] border-b border-slate-200 dark:border-[#2e3a4b]">
                        <tr>
                            <th class="py-3.5 px-6">Judul Materi Pembelajaran</th>
                            <th class="py-3.5 px-6">Identitas Konten</th>
                            <th class="py-3.5 px-6">Waktu Terbit</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-[#2e3a4b]">
                        @forelse($materi as $m)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-[#243044]/40 transition">
                                <td class="py-3.5 px-6 font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-brand-50 dark:bg-brand-950/60 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-xs">
                                        H5P
                                    </div>
                                    <span>{{ $m->judul }}</span>
                                </td>
                                <td class="py-3.5 px-6 font-mono text-slate-500">{{ $m->nama_folder }}</td>
                                <td class="py-3.5 px-6 text-slate-400">{{ $m->created_at->format('d M Y, H:i') }}</td>
                                <td class="py-3.5 px-6 text-right">
                                    <a href="{{ route('materi.kerjakan', $m->id) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-brand-50 hover:bg-brand-100 dark:bg-brand-950/60 dark:hover:bg-brand-900/60 text-brand-600 dark:text-brand-400 text-xs font-semibold transition">
                                        <span>Pratinjau Modul</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400">Belum ada modul yang diunggah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
