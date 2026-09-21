<script setup>
import { onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    materi: Object,
    urlPublik: String,
});

const saveScore = (score, maxScore) => {
    fetch('/materi/nilai', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
        },
        body: JSON.stringify({
            materi_id: props.materi.id,
            skor: score,
            skor_maksimal: maxScore,
        }),
    })
    .then(res => res.json())
    .then(data => {
        if (data.sukses) {
            let ikonMedali = '🥇';
            if (data.lencana === 'Perak') ikonMedali = '🥈';
            if (data.lencana === 'Perunggu') ikonMedali = '🥉';

            let persentase = Math.round((score / Math.max(maxScore, 1)) * 100);

            if (window.Swal) {
                window.Swal.fire({
                    title: 'Kuis Selesai! ' + ikonMedali,
                    html: `
                        <div class="space-y-3 py-2 text-center">
                            <p class="text-sm font-medium text-slate-300">Skor Anda berhasil dicatat ke sistem rapor:</p>
                            <div class="text-4xl font-black text-white">${score} <span class="text-lg text-slate-400">/ ${maxScore}</span></div>
                            <div class="text-xs font-bold uppercase tracking-wider text-indigo-400">Persentase: ${persentase}%</div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-slate-800 border border-slate-700 font-extrabold text-sm text-amber-300">
                                <span>${ikonMedali}</span> Lencana Diraih: ${data.lencana}
                            </div>
                        </div>
                    `,
                    icon: 'success',
                    confirmButtonText: 'Kembali ke Rapor Siswa',
                    confirmButtonColor: '#4f46e5',
                    allowOutsideClick: false,
                    customClass: {
                        popup: 'rounded-3xl shadow-2xl bg-slate-900 border border-slate-800 text-white',
                        confirmButton: 'px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-indigo-500/30'
                    }
                }).then(() => {
                    window.location.href = '/siswa/rapor';
                });
            }
        }
    })
    .catch(err => {
        console.error('Gagal mencatat skor:', err);
    });
};

onMounted(() => {
    const el = document.getElementById('h5p-container');
    const options = {
        h5pJsonPath: props.urlPublik,
        frameJs: 'https://cdn.jsdelivr.net/npm/h5p-standalone@3.8.2/dist/frame.bundle.js',
        frameCss: 'https://cdn.jsdelivr.net/npm/h5p-standalone@3.8.2/dist/styles/h5p.css',
    };

    const H5PClass = window.H5P || (window.H5PStandalone && window.H5PStandalone.H5P);

    if (H5PClass && el) {
        el.innerHTML = '';
        const player = new H5PClass(el, options);

        player.externalDispatcher.on('xAPI', function (event) {
            const statement = event.data.statement;
            if (statement?.result?.score) {
                const score = statement.result.score.raw;
                const maxScore = statement.result.score.max;
                if (score !== undefined && maxScore !== undefined) {
                    saveScore(score, maxScore);
                }
            }
        });
    }
});
</script>

<template>
    <AppLayout>
        <Head :title="`Mengerjakan - ${materi.judul}`" />

        <div class="space-y-6">
            <!-- Bar Navigasi Atas & Info Materi -->
            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md rounded-2xl p-5 border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-black text-sm flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        H5P
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                            <span>Sedang Dikerjakan</span>
                            <span>&bull;</span>
                            <span>Materi Interaktif</span>
                        </div>
                        <h1 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                            {{ materi.judul }}
                        </h1>
                    </div>
                </div>

                <Link href="/beranda" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition self-start sm:self-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Beranda
                </Link>
            </div>

            <!-- Kartu Frame Pemutar H5P Utama -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-4 sm:p-7 border border-slate-200/80 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden relative">
                <!-- Status Perekaman Nilai Otomatis -->
                <div class="mb-5 flex items-center justify-between p-3.5 rounded-2xl bg-indigo-50/70 dark:bg-indigo-950/40 border border-indigo-100 dark:border-indigo-900/50 text-xs text-indigo-800 dark:text-indigo-300">
                    <div class="flex items-center gap-2.5">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-500"></span>
                        </span>
                        <span class="font-medium">Deteksi xAPI Aktif &bull; Nilai kuis Anda akan otomatis tersimpan begitu selesai menjawab.</span>
                    </div>
                    <div class="font-bold text-[11px] hidden sm:block uppercase tracking-wider text-indigo-500">
                        Sinkronisasi Real-time
                    </div>
                </div>

                <!-- Kontainer H5P Player Standalone -->
                <div id="h5p-container" class="w-full min-h-[550px] rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 flex flex-col items-center justify-center relative overflow-hidden transition-all duration-300">
                    <div class="flex flex-col items-center justify-center p-8 text-center space-y-3">
                        <div class="w-12 h-12 border-4 border-indigo-500/30 border-t-indigo-600 rounded-full animate-spin"></div>
                        <p class="font-bold text-slate-700 dark:text-slate-300 text-sm">Menyiapkan Paket H5P...</p>
                        <p class="text-xs text-slate-400 max-w-xs">Mengekstrak aset interaktif modul pembelajaran ke canvas peramban Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
