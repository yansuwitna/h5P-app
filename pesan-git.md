# Panduan Konfigurasi Default Pesan Commit Git

Dokumen ini berisi panduan untuk menggunakan berkas `pesan-git.txt` sebagai template pesan bawaan (*default commit message*) pada Git repository proyek ini.

---

## 1. Fungsi Berkas `pesan-git.txt`
Berkas `pesan-git.txt` berfungsi sebagai draf standar atau cetak biru pesan commit yang mematuhi standar industri (*Conventional Commits*). Format ini menjaga riwayat commit tetap rapi, jelas, dan mudah dibaca oleh tim pengembang.

---

## 2. Cara Mengaktifkan Template Pesan Git

### Opsi A: Mengatur Template Commit Secara Lokal (Hanya untuk Proyek Ini)
Jalankan perintah berikut di dalam terminal root proyek:
```bash
git config commit.template pesan-git.txt
```
Setelah diatur, setiap kali Anda menjalankan perintah:
```bash
git commit
```
Git akan otomatis membuka teks editor default (seperti nano, vim, atau VS Code) dengan isi dari `pesan-git.txt` sudah terisi di dalamnya.

---

### Opsi B: Melakukan Commit Langsung Menggunakan Berkas Template
Jika Anda ingin langsung melakukan commit menggunakan berkas `pesan-git.txt` tanpa membuka editor:
```bash
git commit -F pesan-git.txt
```

---

### Opsi C: Mengatur Template Commit Secara Global (Untuk Semua Repository Anda)
Jika Anda ingin menerapkan template ini pada seluruh repositori Git di komputer Anda:
```bash
git config --global commit.template /home/kali/apps/web/h5p/pesan-git.txt
```

---

## 3. Format Standar Pesan Commit (Conventional Commits)

```
<tipe>(<cakupan opsional>): <ringkasan singkat>

[deskripsi lebih rinci jika diperlukan]
```

### Daftar Tipe Commit yang Direkomendasikan:
- **`feat`**: Penambahan fitur baru ke sistem.
- **`fix`**: Perbaikan bug atau kendala teknis.
- **`ui`**: Pembaruan gaya atau tampilan antarmuka (Tailwind CSS / Vue components).
- **`refactor`**: Penataan ulang struktur kode tanpa mengubah alur logika bisnis.
- **`perf`**: Optimasi performa dan kecepatan render.
- **`docs`**: Perubahan atau pembuatan berkas dokumentasi markdown.
- **`test`**: Penambahan atau perbaikan otomatisasi tes (*Feature / Unit Test*).
- **`chore`**: Pemeliharaan berkas konfigurasi, dependensi npm/composer, atau build tools.

---

## 4. Cara Menonaktifkan Template Commit
Jika sewaktu-waktu ingin mengembalikan ke pesan commit kosong bawaan Git:
```bash
git config --unset commit.template
```
