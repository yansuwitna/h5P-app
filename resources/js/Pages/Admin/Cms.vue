<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    landingSettings: Object,
});

const form = useForm({
    brand_name: props.landingSettings?.brand_name || 'H5PClass',
    nav_link_1: props.landingSettings?.nav_link_1 || 'Fitur Unggulan',
    nav_link_2: props.landingSettings?.nav_link_2 || 'Alur Kerja',
    nav_link_3: props.landingSettings?.nav_link_3 || 'Standar Penilaian',
    hero_badge: props.landingSettings?.hero_badge || 'Platform LMS Generasi Masa Depan',
    hero_title: props.landingSettings?.hero_title || 'Belajar Mandiri Lebih Seru dengan Modul Interaktif H5P',
    hero_subtitle: props.landingSettings?.hero_subtitle || 'Ekosistem pembelajaran berbasis kuis interaktif, video analitis, dan gamifikasi lencana prestasi otomatis yang terukur.',
    hero_cta_text: props.landingSettings?.hero_cta_text || 'Mulai Belajar Sekarang',
    hero_teacher_text: props.landingSettings?.hero_teacher_text || 'Masuk Sebagai Guru',
    feature_tagline: props.landingSettings?.feature_tagline || 'Kemampuan Sistem',
    feature_heading: props.landingSettings?.feature_heading || 'Dirancang untuk Skalabilitas Kelas',
    feature_1_title: props.landingSettings?.feature_1_title || 'Integrasi H5P Tanpa Batas',
    feature_1_desc: props.landingSettings?.feature_1_desc || 'Dukungan penuh ragam format konten interaktif dari Lumi maupun Canva dengan ekstraksi instan.',
    feature_2_title: props.landingSettings?.feature_2_title || 'Penilaian Real-time xAPI',
    feature_2_desc: props.landingSettings?.feature_2_desc || 'Setiap interaksi jawaban siswa langsung terekam otomatis dan dikonversi menjadi laporan capaian.',
    feature_3_title: props.landingSettings?.feature_3_title || 'Gamifikasi & Lencana',
    feature_3_desc: props.landingSettings?.feature_3_desc || 'Motivasi belajar siswa dengan penghargaan lencana Emas, Perak, dan Perunggu berdasarkan capaian kuis.',
    footer_text: props.landingSettings?.footer_text || 'Platform LMS H5P Interaktif Sekolah',
    footer_copyright: props.landingSettings?.footer_copyright || 'Hak Cipta Dilindungi • Dikembangkan untuk Pendidikan',
});

const submit = () => {
    form.post('/admin/landing-settings');
};
</script>

<template>
    <AppLayout>
        <Head title="Kustomisasi Teks Landing Page" />

        <div class="space-y-6">
            <!-- Header Halaman CMS -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#1c2434] p-5 sm:p-6 rounded-2xl border border-slate-200 dark:border-[#2e3a4b] shadow-sm">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 text-xs font-semibold mb-1">
                        <span>Manajemen Konten</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                        Pengaturan Teks Landing Page
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                        Kustomisasi narasi promosi, identitas brand, judul, dan informasi pada halaman beranda utama.
                    </p>
                </div>
                <a href="/" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-[#243044] dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold transition border border-slate-200 dark:border-[#2e3a4b] self-start sm:self-auto">
                    <span>Buka Landing Page</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                </a>
            </div>

            <!-- Formulir CMS Lengkap -->
            <div class="bg-white dark:bg-[#1c2434] rounded-2xl p-6 sm:p-8 border border-slate-200 dark:border-[#2e3a4b] shadow-sm space-y-6">
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- 1. Header & Branding -->
                    <div class="space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400">1. Navigasi & Identitas Brand</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Brand / Logo</label>
                                <input v-model="form.brand_name" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Menu Navigasi 1</label>
                                <input v-model="form.nav_link_1" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Menu Navigasi 2</label>
                                <input v-model="form.nav_link_2" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Menu Navigasi 3</label>
                                <input v-model="form.nav_link_3" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                        </div>
                    </div>

                    <!-- 2. Hero Section -->
                    <div class="space-y-4 pt-5 border-t border-slate-200 dark:border-[#2e3a4b]">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400">2. Bagian Utama (Hero Section)</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Badge Tagline Utama</label>
                                <input v-model="form.hero_badge" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Besar Banner (Hero Title)</label>
                                <input v-model="form.hero_title" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Deskripsi Lengkap Banner (Hero Subtitle)</label>
                            <textarea v-model="form.hero_subtitle" rows="3" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs leading-relaxed"></textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Tombol Aksi Utama</label>
                                <input v-model="form.hero_cta_text" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Tombol Masuk Guru</label>
                                <input v-model="form.hero_teacher_text" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                        </div>
                    </div>

                    <!-- 3. Section Fitur Unggulan -->
                    <div class="space-y-4 pt-5 border-t border-slate-200 dark:border-[#2e3a4b]">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400">3. Bagian Fitur Unggulan</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Tagline Fitur</label>
                                <input v-model="form.feature_tagline" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Bagian Fitur</label>
                                <input v-model="form.feature_heading" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                            <div class="p-4 rounded-xl bg-slate-50/70 dark:bg-[#243044]/60 border border-slate-200 dark:border-[#2e3a4b] space-y-2">
                                <label class="block text-[11px] font-bold uppercase text-slate-400">Fitur 1</label>
                                <input v-model="form.feature_1_title" type="text" placeholder="Judul Fitur 1" class="block w-full px-3 py-1.5 rounded-lg bg-white dark:bg-[#1c2434] border border-slate-300 dark:border-[#2e3a4b] text-xs font-semibold">
                                <textarea v-model="form.feature_1_desc" rows="3" placeholder="Deskripsi Fitur 1" class="block w-full px-3 py-1.5 rounded-lg bg-white dark:bg-[#1c2434] border border-slate-300 dark:border-[#2e3a4b] text-xs"></textarea>
                            </div>
                            <div class="p-4 rounded-xl bg-slate-50/70 dark:bg-[#243044]/60 border border-slate-200 dark:border-[#2e3a4b] space-y-2">
                                <label class="block text-[11px] font-bold uppercase text-slate-400">Fitur 2</label>
                                <input v-model="form.feature_2_title" type="text" placeholder="Judul Fitur 2" class="block w-full px-3 py-1.5 rounded-lg bg-white dark:bg-[#1c2434] border border-slate-300 dark:border-[#2e3a4b] text-xs font-semibold">
                                <textarea v-model="form.feature_2_desc" rows="3" placeholder="Deskripsi Fitur 2" class="block w-full px-3 py-1.5 rounded-lg bg-white dark:bg-[#1c2434] border border-slate-300 dark:border-[#2e3a4b] text-xs"></textarea>
                            </div>
                            <div class="p-4 rounded-xl bg-slate-50/70 dark:bg-[#243044]/60 border border-slate-200 dark:border-[#2e3a4b] space-y-2">
                                <label class="block text-[11px] font-bold uppercase text-slate-400">Fitur 3</label>
                                <input v-model="form.feature_3_title" type="text" placeholder="Judul Fitur 3" class="block w-full px-3 py-1.5 rounded-lg bg-white dark:bg-[#1c2434] border border-slate-300 dark:border-[#2e3a4b] text-xs font-semibold">
                                <textarea v-model="form.feature_3_desc" rows="3" placeholder="Deskripsi Fitur 3" class="block w-full px-3 py-1.5 rounded-lg bg-white dark:bg-[#1c2434] border border-slate-300 dark:border-[#2e3a4b] text-xs"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Bagian Footer -->
                    <div class="space-y-4 pt-5 border-t border-slate-200 dark:border-[#2e3a4b]">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400">4. Bagian Footer</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Kiri Footer</label>
                                <input v-model="form.footer_text" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Hak Cipta Kanan</label>
                                <input v-model="form.footer_copyright" type="text" class="block w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-[#243044] border border-slate-300 dark:border-[#2e3a4b] text-xs">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" :disabled="form.processing" class="px-6 py-3 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold shadow-md transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            <span>{{ form.processing ? 'Menyimpan...' : 'Simpan Perubahan Teks Landing Page' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
