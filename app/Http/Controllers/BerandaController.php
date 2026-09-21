<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MateriH5p;
use App\Models\Nilai;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function redirectByRole()
    {
        $pengguna = Auth::user();
        $role = session('role', $pengguna->role ?? 'student');

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'teacher') {
            return redirect()->route('guru.dashboard');
        } else {
            return redirect()->route('siswa.dashboard');
        }
    }

    public function adminDashboard()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'admin') {
            return $this->redirectByRole();
        }

        $totalGuru = Guru::count();
        $totalSiswa = Siswa::count();
        $totalMateri = MateriH5p::count();
        $daftarGuru = Guru::latest()->take(5)->get();
        $daftarSiswa = Siswa::latest()->take(5)->get();
        return view('dashboard.admin', compact('totalGuru', 'totalSiswa', 'totalMateri', 'daftarGuru', 'daftarSiswa'));
    }

    public function adminGuru()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'admin') return $this->redirectByRole();

        $daftarGuru = Guru::latest()->get();
        return view('admin.guru', compact('daftarGuru'));
    }

    public function adminSiswa()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'admin') return $this->redirectByRole();

        $daftarSiswa = Siswa::latest()->get();
        return view('admin.siswa', compact('daftarSiswa'));
    }

    public function adminCms()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'admin') return $this->redirectByRole();

        $landingSettings = \App\Models\LandingSetting::getAllSettings();
        return view('admin.cms', compact('landingSettings'));
    }

    public function guruDashboard()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'teacher') {
            return $this->redirectByRole();
        }

        $pengguna = Auth::user();
        $siswa = Siswa::all();
        $materi = MateriH5p::where('guru_id', $pengguna->id)->get();
        return view('dashboard.teacher', compact('siswa', 'materi'));
    }

    public function guruSiswa()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'teacher') return $this->redirectByRole();

        $siswa = Siswa::all();
        return view('guru.siswa', compact('siswa'));
    }

    public function guruMateri()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'teacher') return $this->redirectByRole();

        $pengguna = Auth::user();
        $materi = MateriH5p::where('guru_id', $pengguna->id)->get();
        return view('guru.materi', compact('materi'));
    }

    public function siswaDashboard()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'student') {
            return $this->redirectByRole();
        }

        $pengguna = Auth::user();
        $materi = MateriH5p::all();
        $nilai = Nilai::where('siswa_id', $pengguna->id)->with('materi')->get();
        return view('dashboard.student', compact('materi', 'nilai'));
    }

    public function siswaMateri()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'student') return $this->redirectByRole();

        $pengguna = Auth::user();
        $materi = MateriH5p::all();
        $nilai = Nilai::where('siswa_id', $pengguna->id)->get();
        return view('siswa.materi', compact('materi', 'nilai'));
    }

    public function siswaRapor()
    {
        $role = session('role', Auth::user()->role ?? 'student');
        if ($role !== 'student') return $this->redirectByRole();

        $pengguna = Auth::user();
        $nilai = Nilai::where('siswa_id', $pengguna->id)->with('materi')->get();
        return view('siswa.rapor', compact('nilai'));
    }

    public function updateLandingSettings(Request $request)
    {
        $data = $request->except(['_token']);

        foreach ($data as $key => $value) {
            \App\Models\LandingSetting::setVal($key, $value);
        }

        return redirect()->route('admin.dashboard')->with('sukses', 'Pengaturan teks Landing Page berhasil diperbarui.');
    }

    public function daftarGuruManual(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:50|unique:tbl_guru,nik',
            'email' => 'nullable|string|email|max:255',
            'kata_sandi' => 'required|string|min:6',
        ]);

        Guru::create([
            'name' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => Hash::make($request->kata_sandi),
        ]);

        return redirect()->route('admin.dashboard')->with('sukses', 'Akun Guru baru (NIK: ' . $request->nik . ') berhasil dibuat oleh Admin.');
    }

    public function daftarSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:50|unique:tbl_siswa,nisn',
            'email' => 'nullable|string|email|max:255',
            'kata_sandi' => 'required|string|min:6',
        ]);

        Siswa::create([
            'name' => $request->nama,
            'nisn' => $request->nisn,
            'email' => $request->email,
            'password' => Hash::make($request->kata_sandi),
        ]);

        return redirect()->route('guru.dashboard')->with('sukses', 'Siswa baru (NISN: ' . $request->nisn . ') berhasil didaftarkan ke tabel siswa.');
    }

    public function importGuruExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,csv,txt|max:5120',
        ]);

        $file = $request->file('file_excel');
        $extension = $file->getClientOriginalExtension();

        try {
            $rows = \App\Services\ExcelReader::readRows($file->getRealPath(), $extension);
        } catch (\Exception $e) {
            return redirect()->route('beranda')->with('error', 'Gagal memproses berkas Excel: ' . $e->getMessage());
        }

        if (count($rows) <= 1) {
            return redirect()->route('beranda')->with('error', 'Berkas Excel kosong atau hanya berisi baris judul header.');
        }

        // Baris 0 diasumsikan sebagai Header (Nama, NIK, Email, Password)
        // Kita loop baris mulai dari indeks 1
        $berhasil = 0;
        $dilewati = 0;

        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];
            $name = trim($row[0] ?? '');
            $nik = trim($row[1] ?? '');
            $email = trim($row[2] ?? '');
            $password = trim($row[3] ?? '');

            if (empty($nik) || empty($name)) {
                $dilewati++;
                continue;
            }

            // Jika kata sandi kosong, default ke NIK
            $hashedPassword = Hash::make(!empty($password) ? $password : $nik);

            // Simpan atau perbarui berdasarkan NIK
            Guru::updateOrCreate(
                ['nik' => $nik],
                [
                    'name' => $name,
                    'email' => !empty($email) ? $email : null,
                    'password' => $hashedPassword,
                ]
            );

            $berhasil++;
        }

        return redirect()->route('admin.dashboard')->with('sukses', "Import data guru selesai: {$berhasil} data berhasil disimpan/diperbarui, {$dilewati} baris dilewati.");
    }

    public function importSiswaExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,csv,txt|max:5120',
        ]);

        $file = $request->file('file_excel');
        $extension = $file->getClientOriginalExtension();

        try {
            $rows = \App\Services\ExcelReader::readRows($file->getRealPath(), $extension);
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Gagal memproses berkas Excel: ' . $e->getMessage());
        }

        if (count($rows) <= 1) {
            return redirect()->route('admin.dashboard')->with('error', 'Berkas Excel kosong atau hanya berisi baris judul header.');
        }

        $berhasil = 0;
        $dilewati = 0;

        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];
            $name = trim($row[0] ?? '');
            $nisn = trim($row[1] ?? '');
            $email = trim($row[2] ?? '');
            $password = trim($row[3] ?? '');

            if (empty($nisn) || empty($name)) {
                $dilewati++;
                continue;
            }

            // Jika kata sandi kosong, default ke NISN
            $hashedPassword = Hash::make(!empty($password) ? $password : $nisn);

            // Simpan atau perbarui berdasarkan NISN
            Siswa::updateOrCreate(
                ['nisn' => $nisn],
                [
                    'name' => $name,
                    'email' => !empty($email) ? $email : null,
                    'password' => $hashedPassword,
                ]
            );

            $berhasil++;
        }

        return redirect()->route('admin.dashboard')->with('sukses', "Import data siswa selesai: {$berhasil} data berhasil disimpan/diperbarui, {$dilewati} baris dilewati.");
    }
}

