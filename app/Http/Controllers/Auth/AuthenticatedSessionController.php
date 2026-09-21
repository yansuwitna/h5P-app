<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle multi-table sequential authentication:
     * 1. Check Admin by 'username'
     * 2. If not found or wrong, check Guru by 'nik'
     * 3. If not found or wrong, check Siswa by 'nisn'
     * 4. If all fail, throw error.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginIdentifier = trim($request->login);
        $password = $request->password;
        $remember = $request->boolean('remember');

        // 1. Uji Tabel Admin (berdasarkan username)
        $admin = Admin::where('username', $loginIdentifier)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin, $remember);
            // Login juga ke default web guard agar kompatibel dengan sistem
            Auth::guard('web')->login($admin, $remember);
            $request->session()->regenerate();
            $request->session()->put('role', 'admin');
            return redirect()->intended(route('admin.dashboard'));
        }

        // 2. Uji Tabel Guru (berdasarkan NIK)
        $guru = Guru::where('nik', $loginIdentifier)->first();
        if ($guru && Hash::check($password, $guru->password)) {
            Auth::guard('guru')->login($guru, $remember);
            Auth::guard('web')->login($guru, $remember);
            $request->session()->regenerate();
            $request->session()->put('role', 'teacher');
            return redirect()->intended(route('guru.dashboard'));
        }

        // 3. Uji Tabel Siswa (berdasarkan NISN)
        $siswa = Siswa::where('nisn', $loginIdentifier)->first();
        if ($siswa && Hash::check($password, $siswa->password)) {
            Auth::guard('siswa')->login($siswa, $remember);
            Auth::guard('web')->login($siswa, $remember);
            $request->session()->regenerate();
            $request->session()->put('role', 'student');
            return redirect()->intended(route('siswa.dashboard'));
        }

        // 4. Jika semua tabel tidak cocok atau kredensial salah
        throw ValidationException::withMessages([
            'login' => 'Kredensial tidak ditemukan pada sistem (Admin / Guru NIK / Siswa NISN) atau kata sandi salah.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('guru')->logout();
        Auth::guard('siswa')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
