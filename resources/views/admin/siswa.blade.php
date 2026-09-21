<x-app-layout>
    <div class="space-y-6">

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#1c2434] p-5 sm:p-6 rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm">
            <div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 text-xs font-semibold mb-1">
                    <span>Manajemen Siswa</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                    Data Siswa Terdaftar
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    Kelola akun peserta didik yang dapat mengakses katalog materi pembelajaran interaktif secara mandiri.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-[#243044] text-slate-700 dark:text-slate-200 font-semibold border border-slate-200 dark:border-[#2e3a4b]">
                    Total: {{ count($daftarSiswa) }} Siswa
                </span>
            </div>
        </div>

        <!-- Box Import & Tambah Manual Siswa -->
        <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm overflow-hidden" x-data="{ tab: 'excel' }">
            <div class="p-5 border-b border-slate-200 dark:border-[#2e3a4b] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <button type="button" @click="tab = 'excel'" :class="tab === 'excel' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-[#243044] text-slate-600 dark:text-slate-300'" class="px-3.5 py-2 rounded-xl text-xs font-semibold transition">
                        Import Data via Excel / CSV
                    </button>
                    <button type="button" @click="tab = 'manual'" :class="tab === 'manual' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-[#243044] text-slate-600 dark:text-slate-300'" class="px-3.5 py-2 rounded-xl text-xs font-semibold transition">
                        + Tambah Siswa Baru
                    </button>
                </div>
                <span x-show="tab === 'excel'" class="text-xs text-slate-400 font-mono">Format kolom: Nama | NISN | Email | Password</span>
            </div>

            <!-- Form Import Excel Siswa -->
            <div x-show="tab === 'excel'" class="p-5 bg-slate-50/50 dark:bg-[#1c2434]/40 border-b border-slate-200 dark:border-[#2e3a4b]">
                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center gap-3">
                    @csrf
                    <input type="file" name="file_excel" accept=".xlsx,.csv,.txt" required
                        class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-950 dark:file:text-blue-300 hover:file:bg-blue-100 cursor-pointer border border-slate-200 dark:border-[#2e3a4b] rounded-xl p-1.5 bg-white dark:bg-[#243044]" />
                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs transition shadow-sm shrink-0 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                        <span>Mulai Unggah Excel</span>
                    </button>
                </form>
            </div>

            <!-- Form Tambah Siswa Manual -->
            <div x-show="tab === 'manual'" class="p-5 bg-slate-50/50 dark:bg-[#1c2434]/40 border-b border-slate-200 dark:border-[#2e3a4b]" style="display: none;">
                <form action="{{ route('siswa.daftar') }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap Siswa</label>
                            <input type="text" name="nama" required placeholder="Contoh: Muhammad Rizky Pratama" class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">NISN (Nomor Induk Siswa Nasional - Kredensial Login)</label>
                            <input type="text" name="nisn" required placeholder="Contoh: 0081234567" class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs font-mono">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Alamat Email (Opsional)</label>
                            <input type="email" name="email" placeholder="Contoh: rizky@siswa.sch.id" class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kata Sandi (Minimal 6 Karakter)</label>
                            <input type="password" name="kata_sandi" required placeholder="Masukkan kata sandi siswa" class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-[#243044] border border-slate-200 dark:border-[#2e3a4b] text-xs">
                        </div>
                    </div>
                    <div class="flex justify-end pt-1">
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs transition shadow-sm">
                            Simpan Akun Siswa
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabel Data Siswa Lengkap -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead class="bg-slate-50/70 dark:bg-[#243044] text-slate-500 dark:text-slate-400 uppercase font-semibold text-[11px] border-b border-slate-200 dark:border-[#2e3a4b]">
                        <tr>
                            <th class="py-3.5 px-6">Nama Peserta Didik</th>
                            <th class="py-3.5 px-6">NISN (Login)</th>
                            <th class="py-3.5 px-6">Email Terdaftar</th>
                            <th class="py-3.5 px-6">Waktu Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-[#2e3a4b]">
                        @forelse($daftarSiswa as $s)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-[#243044]/40 transition">
                                <td class="py-3.5 px-6 font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($s->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $s->name }}</span>
                                </td>
                                <td class="py-3.5 px-6 font-mono font-semibold text-blue-600 dark:text-blue-400">{{ $s->nisn }}</td>
                                <td class="py-3.5 px-6 text-slate-500">{{ $s->email ?? '-' }}</td>
                                <td class="py-3.5 px-6 text-slate-400">{{ $s->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400">Belum ada akun siswa yang terdaftar dalam sistem.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
