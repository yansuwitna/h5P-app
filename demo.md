# 🎓 Panduan Penggunaan Akun Demo Multi-Tabel LMS H5P

Selamat datang di platform **LMS Pembelajaran Interaktif Berbasis H5P**!  
Aplikasi telah menggunakan sistem **Multi-Tabel Authentication** dengan alur deteksi otomatis berurutan:
1. Mengecek tabel `tbl_admin` berdasarkan **Username**.
2. Jika tidak ditemukan / tidak cocok, mengecek tabel `tbl_guru` berdasarkan **NIK**.
3. Jika tidak ditemukan / tidak cocok, mengecek tabel `tbl_siswa` berdasarkan **NISN**.
4. Jika tidak ditemukan di ketiga tabel tersebut, sistem baru menampilkan informasi gagal.

---

## 🔑 Kredensial Akun Uji Coba Multi-Tabel

Semua akun ini telah dibuat secara otomatis melalui seeder database (`php artisan db:seed`):

### 1. Akun Administrator (Tabel `tbl_admin`)
* **Pengenal Login:** `admin` (Username)
* **Kata Sandi:** `admin123`
* **Nama:** Super Administrator
* **Hak Akses:** 
  - Panel kontrol utama data Guru, Siswa, dan Modul H5P
  - **Manajer Konten Landing Page (CMS):** Mengubah seluruh teks narasi pada landing page (Logo/Brand, Menu Navigasi, Hero Headline, Subtitle, Tombol CTA, Rincian 3 Fitur Unggulan, hingga Teks Hak Cipta Footer) langsung dari dashboard.

---

### 2. Akun Guru (Tabel `tbl_guru`)
* **Pengenal Login:** `3201019876540001` (NIK)
* **Kata Sandi:** `password123`
* **Nama:** Bapak Hendra Gunawan, M.Pd
* **Hak Akses:** Unggah materi modul H5P, mendaftarkan siswa dengan NISN, dan pratinjau modul

*(Akun Guru Cadangan: NIK `3201019876540002` | Sandi `password123` - Ibu Ratna Dewi, S.Pd)*

---

### 3. Akun Siswa 1 (Tabel `tbl_siswa` - Berprestasi)
* **Pengenal Login:** `0081234567` (NISN)
* **Kata Sandi:** `password123`
* **Nama:** Aditya Pratama (Juara Kelas)
* **Hak Akses:** Mengerjakan modul H5P, melihat rapor nilai, dan koleksi medali Emas 🥇 & Perak 🥈

---

### 4. Akun Siswa 2 (Tabel `tbl_siswa` - Siswa Baru)
* **Pengenal Login:** `0087654321` (NISN)
* **Kata Sandi:** `password123`
* **Nama:** Budi Santoso (Siswa Baru)
* **Hak Akses:** Siswa baru yang siap mencoba kuis interaktif dari awal

---

## 🚀 Cara Menjalankan Aplikasi

1. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
2. Buka browser di: 👉 **[http://localhost:8000](http://localhost:8000)**
3. Klik tombol **Masuk Portal** di sudut kanan atas.
4. Masukkan salah satu pengenal di atas (Username Admin, NIK Guru, atau NISN Siswa) beserta kata sandinya. Sistem akan otomatis mengarahkan ke dashboard yang sesuai peran Anda!
