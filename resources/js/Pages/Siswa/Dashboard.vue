<script setup>
import { computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    materi: Array,
    nilai: Array,
});

const page = usePage();
const auth = page.props.auth || {};
const user = auth.user || {};

const totalTugas = computed(() => props.materi?.length ?? 0);
const selesai = computed(() => props.nilai?.length ?? 0);
const persenSelesai = computed(() => {
    if (totalTugas.value === 0) return 0;
    return Math.round((selesai.value / totalTugas.value) * 100);
});

const emasCount = computed(() => (props.nilai || []).filter(n => n.lencana === 'Emas').length);
const perakCount = computed(() => (props.nilai || []).filter(n => n.lencana === 'Perak').length);
const perungguCount = computed(() => (props.nilai || []).filter(n => n.lencana === 'Perunggu').length);

const getNilaiMateri = (materiId) => {
    return (props.nilai || []).find(n => n.materi_id === materiId);
};
</script>

<template>
    <AppLayout>
        <Head title="Ruang Belajar Siswa Mandiri" />

        <div class="space-y-6">
            <!-- 1. Banner Sambutan Siswa & Progress Belajar Cepat -->
            <div class="bg-gradient-to-r from-indigo-600 via-indigo-700 to-slate-900 rounded-2xl p-6 sm:p-7 text-white shadow-lg relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold text-indigo-100 border border-white/20">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Ruang Belajar Siswa Mandiri</span>
                            <span>&bull;</span>
                            <span class="font-mono">{{ user?.nisn ?? 'Siswa' }}</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
                            Selamat Belajar, {{ user?.name }}! 👋
                        </h1>
                        <p class="text-indigo-100 text-xs sm:text-sm leading-relaxed max-w-xl">
                            Semua modul pelajaran interaktif H5P Anda langsung tersedia di bawah. Klik tombol untuk memulai pengerjaan kuis dan raih medali prestasi!
                        </p>
                    </div>

                    <!-- Progress Ringkas & Medali -->
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-4 shrink-0 flex items-center gap-4">
                        <div class="text-center pr-3 border-r border-white/20">
                            <span class="text-[10px] uppercase font-bold text-indigo-200 block">Progres</span>
                            <span class="text-xl font-bold font-mono">{{ selesai }}/{{ totalTugas }}</span>
                            <span class="text-[10px] text-emerald-300 block font-semibold">{{ persenSelesai }}% Selesai</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-center">
                            <div class="px-2 py-1 bg-black/20 rounded-lg">
                                <span class="text-base block">🥇</span>
                                <span class="text-[10px] font-bold">{{ emasCount }}</span>
                            </div>
                            <div class="px-2 py-1 bg-black/20 rounded-lg">
                                <span class="text-base block">🥈</span>
                                <span class="text-[10px] font-bold">{{ perakCount }}</span>
                            </div>
                            <div class="px-2 py-1 bg-black/20 rounded-lg">
                                <span class="text-base block">🥉</span>
                                <span class="text-[10px] font-bold">{{ perungguCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Utama: 2 Kolom Seimbang -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                <!-- Sisi Kiri: Katalog Modul (7 Kolom) -->
                <div class="lg:col-span-7 space-y-4">
                    <div class="flex items-center justify-between pb-1">
                        <div>
                            <h2 class="text-base font-bold text-slate-900 dark:text-white">Pilih Modul Pembelajaran</h2>
                            <p class="text-xs text-slate-400">Kerjakan kuis interaktif secara mandiri</p>
                        </div>
                        <Link href="/siswa/materi" class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">
                            Katalog Lengkap &rarr;
                        </Link>
                    </div>

                    <div class="space-y-3">
                        <div v-for="m in materi" :key="m.id" class="bg-white dark:bg-[#1c2434] rounded-2xl p-4 sm:p-5 border border-slate-200 dark:border-[#2e3a4b] hover:border-brand-500 transition-all shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="space-y-1.5 max-w-md">
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-purple-50 text-purple-700 dark:bg-purple-950/60 dark:text-purple-300">
                                        H5P
                                    </span>
                                    <span v-if="getNilaiMateri(m.id)" class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-amber-50 text-amber-700 dark:bg-amber-950/50 dark:text-amber-300">
                                        Lencana {{ getNilaiMateri(m.id).lencana }} &bull; {{ getNilaiMateri(m.id).skor }}/{{ getNilaiMateri(m.id).skor_maksimal }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-slate-900 dark:text-white text-sm">
                                    {{ m.judul }}
                                </h3>
                                <p class="text-xs text-slate-400">
                                    Guru: {{ m.guru?.name ?? 'Tenaga Pendidik' }}
                                </p>
                            </div>

                            <a :href="`/materi/kerjakan/${m.id}`" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold transition shrink-0" :class="getNilaiMateri(m.id) ? 'bg-slate-100 dark:bg-[#243044] text-slate-700 dark:text-slate-200 hover:bg-slate-200' : 'bg-brand-600 hover:bg-brand-700 text-white shadow-sm'">
                                <span>{{ getNilaiMateri(m.id) ? 'Ulangi Kuis' : 'Mulai Belajar' }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                        <p v-if="!materi || materi.length === 0" class="text-xs text-slate-400 py-6 text-center bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b]">Belum ada modul pembelajaran yang tersedia.</p>
                    </div>
                </div>

                <!-- Sisi Kanan: Rapor Ringkas (5 Kolom) -->
                <div class="lg:col-span-5 space-y-4">
                    <div class="flex items-center justify-between pb-1">
                        <div>
                            <h2 class="text-base font-bold text-slate-900 dark:text-white">Rapor Capaian Anda</h2>
                            <p class="text-xs text-slate-400">Skor hasil kuis yang tersimpan otomatis</p>
                        </div>
                        <Link href="/siswa/rapor" class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline">
                            Lihat Rapor &rarr;
                        </Link>
                    </div>

                    <div class="bg-white dark:bg-[#1c2434] rounded-2xl border border-slate-200 dark:border-[#2e3a4b] p-5 shadow-sm space-y-3">
                        <div v-for="n in (nilai || []).slice(0, 5)" :key="n.id" class="p-3 rounded-xl bg-slate-50 dark:bg-[#243044]/50 border border-slate-100 dark:border-[#2e3a4b] flex items-center justify-between text-xs">
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white truncate max-w-[180px]">{{ n.materi?.judul ?? 'Modul H5P' }}</h4>
                                <span class="text-[11px] text-slate-400 font-mono">Skor: {{ n.skor }}/{{ n.skor_maksimal }}</span>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300">
                                <span>{{ n.lencana === 'Emas' ? '🥇' : (n.lencana === 'Perak' ? '🥈' : '🥉') }}</span>
                                {{ n.lencana }}
                            </span>
                        </div>
                        <p v-if="!nilai || nilai.length === 0" class="text-xs text-slate-400 py-6 text-center">Belum ada nilai tersimpan.</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
