<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\MateriH5p;
use App\Models\Nilai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. SEED TABEL `admin` (Login via username)
        // ==========================================
        $admin = Admin::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('admin123'),
            ]
        );

        // ==========================================
        // 2. SEED TABEL `guru` (Login via NIK)
        // ==========================================
        $guru = Guru::firstOrCreate(
            ['nik' => '3201019876540001'],
            [
                'name' => 'Bapak Hendra Gunawan, M.Pd',
                'email' => 'guru@demo.com',
                'password' => Hash::make('password123'),
            ]
        );

        // Guru kedua untuk variasi
        Guru::firstOrCreate(
            ['nik' => '3201019876540002'],
            [
                'name' => 'Ibu Ratna Dewi, S.Pd',
                'email' => 'ratna@demo.com',
                'password' => Hash::make('password123'),
            ]
        );

        // ==========================================
        // 3. SEED TABEL `siswa` (Login via NISN)
        // ==========================================
        $siswa1 = Siswa::firstOrCreate(
            ['nisn' => '0081234567'],
            [
                'name' => 'Aditya Pratama (Juara Kelas)',
                'email' => 'aditya@demo.com',
                'password' => Hash::make('password123'),
            ]
        );

        $siswa2 = Siswa::firstOrCreate(
            ['nisn' => '0087654321'],
            [
                'name' => 'Budi Santoso (Siswa Baru)',
                'email' => 'budi@demo.com',
                'password' => Hash::make('password123'),
            ]
        );

        // ==========================================
        // 4. Sinkronisasi Akun Default User (Cadangan)
        // ==========================================
        User::firstOrCreate(
            ['email' => 'teacher@h5p.com'],
            [
                'name' => 'Guru Penguji',
                'password' => Hash::make('password'),
                'role' => 'teacher'
            ]
        );

        // ==========================================
        // 5. Materi H5P Dummy & Riwayat Nilai
        // ==========================================
        $folderDummy1 = 'h5p_demo_tatasurya';
        $folderDummy2 = 'h5p_demo_biologi';

        $materi1 = MateriH5p::firstOrCreate(
            ['nama_folder' => $folderDummy1],
            [
                'judul' => 'Kuis Interaktif: Sistem Tata Surya & Planet',
                'lokasi_file' => 'materi_unggahan/' . $folderDummy1 . '/content.h5p',
                'guru_id' => $guru->id,
            ]
        );

        $materi2 = MateriH5p::firstOrCreate(
            ['nama_folder' => $folderDummy2],
            [
                'judul' => 'Uji Pemahaman: Struktur Sel Tumbuhan & Hewan',
                'lokasi_file' => 'materi_unggahan/' . $folderDummy2 . '/content.h5p',
                'guru_id' => $guru->id,
            ]
        );

        $targetEkstrak1 = storage_path('app/public/ekstrak_h5p/' . $folderDummy1);
        $targetEkstrak2 = storage_path('app/public/ekstrak_h5p/' . $folderDummy2);

        if (!File::exists($targetEkstrak1)) {
            File::makeDirectory($targetEkstrak1, 0777, true, true);
            File::put($targetEkstrak1 . '/h5p.json', json_encode(['title' => 'Tata Surya', 'mainLibrary' => 'H5P.MultiChoice']));
        }

        if (!File::exists($targetEkstrak2)) {
            File::makeDirectory($targetEkstrak2, 0777, true, true);
            File::put($targetEkstrak2 . '/h5p.json', json_encode(['title' => 'Biologi Sel', 'mainLibrary' => 'H5P.TrueFalse']));
        }

        // Riwayat Nilai untuk Siswa 1
        Nilai::firstOrCreate(
            [
                'siswa_id' => $siswa1->id,
                'materi_id' => $materi1->id,
            ],
            [
                'skor' => 95,
                'skor_maksimal' => 100,
                'lencana' => 'Emas',
            ]
        );

        Nilai::firstOrCreate(
            [
                'siswa_id' => $siswa1->id,
                'materi_id' => $materi2->id,
            ],
            [
                'skor' => 85,
                'skor_maksimal' => 100,
                'lencana' => 'Perak',
            ]
        );

        // ==========================================
        // 5. DEFAULT LANDING PAGE SETTINGS
        // ==========================================
        $landingDefaults = [
            'brand_name' => 'H5PClass',
            'nav_link_1' => 'Fitur Unggulan',
            'nav_link_2' => 'Alur Kerja',
            'nav_link_3' => 'Standar Penilaian',
            'hero_badge' => 'Ekosistem Pembelajaran H5P • Versi 2.0',
            'hero_title' => 'Platform Manajemen Materi & Kuis Interaktif Berbasis Standar Industri',
            'hero_subtitle' => 'Kelola distribusi konten H5P interaktif, pantau ketercapaian belajar siswa secara terpusat, dan integrasikan dengan media penyimpanan fleksibel.',
            'hero_cta_primary' => 'Masuk ke Portal',
            'hero_cta_secondary' => 'Pelajari Fitur',
            'feature_tagline' => 'Kemampuan Sistem',
            'feature_heading' => 'Dirancang untuk Skalabilitas Kelas',
            'feature_1_title' => 'Ekstraksi Modul H5P Otomatis',
            'feature_1_desc' => 'Sistem secara otomatis membongkar arsip materi .h5p ke repositori server sehingga dapat dimainkan langsung di peramban tanpa konfigurasi rumit.',
            'feature_2_title' => 'Fleksibilitas Media Penyimpanan',
            'feature_2_desc' => 'Mendukung penyimpanan ganda baik di disk server lokal maupun integrasi langsung dengan Google Drive Cloud via Flysystem API.',
            'feature_3_title' => 'Pelacakan xAPI & Evaluasi Nilai',
            'feature_3_desc' => 'Setiap jawaban yang dikirimkan oleh siswa dicatat secara presisi melalui protokol xAPI standar untuk menghasilkan rekapitulasi nilai dan lencana capaian.',
            'footer_text' => 'H5P Class • Sistem LMS Pembelajaran Terpadu',
            'footer_copyright' => 'Hak Cipta Dilindungi',
        ];

        foreach ($landingDefaults as $key => $val) {
            \App\Models\LandingSetting::firstOrCreate(['key' => $key], ['value' => $val]);
        }
    }
}
