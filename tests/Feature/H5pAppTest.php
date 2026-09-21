<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\MateriH5p;
use App\Models\Nilai;
use Illuminate\Support\Facades\Hash;

class H5pAppTest extends TestCase
{
    public function test_halaman_utama_landing_page_bisa_diakses(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertInertia(fn (\Inertia\Testing\AssertableInertia $page) => $page
            ->component('Welcome')
            ->has('settings')
            ->has('totalMateri')
            ->has('totalGuru')
            ->has('totalSiswa')
        );
    }

    public function test_halaman_login_bisa_diakses(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertInertia(fn (\Inertia\Testing\AssertableInertia $page) => $page
            ->component('Auth/Login')
        );
    }

    public function test_multi_table_login_admin(): void
    {
        Admin::firstOrCreate(
            ['username' => 'admin_test'],
            ['name' => 'Admin Test', 'password' => Hash::make('password123')]
        );

        $response = $this->post(route('login'), [
            'login' => 'admin_test',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs(Admin::where('username', 'admin_test')->first(), 'admin');

        // Pastikan halaman /admin dapat diakses dengan sukses
        $adminPage = $this->get('/admin');
        $adminPage->assertStatus(200);
        $adminPage->assertInertia(fn (\Inertia\Testing\AssertableInertia $page) => $page
            ->component('Admin/Dashboard')
            ->has('totalGuru')
            ->has('totalSiswa')
            ->has('totalMateri')
        );
    }

    public function test_multi_table_login_guru_nik(): void
    {
        Guru::firstOrCreate(
            ['nik' => '9999999999'],
            ['name' => 'Guru Test NIK', 'password' => Hash::make('password123')]
        );

        $response = $this->post(route('login'), [
            'login' => '9999999999',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('guru.dashboard'));
        $this->assertAuthenticatedAs(Guru::where('nik', '9999999999')->first(), 'guru');

        // Pastikan halaman /guru dapat diakses dengan sukses
        $guruPage = $this->get('/guru');
        $guruPage->assertStatus(200);
        $guruPage->assertInertia(fn (\Inertia\Testing\AssertableInertia $page) => $page
            ->component('Guru/Dashboard')
            ->has('siswa')
            ->has('materi')
        );
    }

    public function test_multi_table_login_siswa_nisn(): void
    {
        Siswa::firstOrCreate(
            ['nisn' => '8888888888'],
            ['name' => 'Siswa Test NISN', 'password' => Hash::make('password123')]
        );

        $response = $this->post(route('login'), [
            'login' => '8888888888',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('siswa.dashboard'));
        $this->assertAuthenticatedAs(Siswa::where('nisn', '8888888888')->first(), 'siswa');

        // Pastikan halaman /siswa dapat diakses dengan sukses
        $siswaPage = $this->get('/siswa');
        $siswaPage->assertStatus(200);
        $siswaPage->assertInertia(fn (\Inertia\Testing\AssertableInertia $page) => $page
            ->component('Siswa/Dashboard')
            ->has('materi')
            ->has('nilai')
        );
    }

    public function test_login_gagal_jika_tidak_ada_di_semua_tabel(): void
    {
        $response = $this->post(route('login'), [
            'login' => 'kredensial_palsu_123',
            'password' => 'password_salah',
        ]);

        $response->assertSessionHasErrors('login');
    }

    public function test_admin_bisa_mengubah_text_landing_page(): void
    {
        $admin = Admin::firstOrCreate(
            ['username' => 'admin'],
            ['name' => 'Administrator', 'password' => Hash::make('password')]
        );

        $response = $this->actingAs($admin, 'admin')->post(route('admin.landing.update'), [
            'brand_name' => 'CustomBrand',
            'hero_title' => 'Judul Kustom Dari Admin',
            'hero_subtitle' => 'Deskripsi Baru yang Diubah',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertEquals('CustomBrand', \App\Models\LandingSetting::getVal('brand_name'));
        $this->assertEquals('Judul Kustom Dari Admin', \App\Models\LandingSetting::getVal('hero_title'));

        // Cek halaman depan props via Inertia
        $landingResponse = $this->get('/');
        $landingResponse->assertInertia(fn (\Inertia\Testing\AssertableInertia $page) => $page
            ->component('Welcome')
            ->where('settings.brand_name', 'CustomBrand')
            ->where('settings.hero_title', 'Judul Kustom Dari Admin')
        );
    }

    public function test_admin_bisa_import_guru_dan_siswa_via_excel_csv(): void
    {
        $admin = Admin::firstOrCreate(
            ['username' => 'admin'],
            ['name' => 'Administrator', 'password' => Hash::make('password')]
        );

        $csvGuruContent = "Nama Guru,NIK,Email,Password\n" .
                          "Budi Santoso,NIK112233,budi@guru.sch.id,secret123\n" .
                          "Siti Rahayu,NIK998866,siti@guru.sch.id,secret456\n";

        $fileGuru = \Illuminate\Http\UploadedFile::fake()->createWithContent('import_guru.csv', $csvGuruContent);

        $responseGuru = $this->actingAs($admin, 'admin')->post(route('admin.guru.import'), [
            'file_excel' => $fileGuru,
        ]);

        $responseGuru->assertRedirect(route('admin.dashboard'));
        $this->assertDatabaseHas('tbl_guru', ['nik' => 'NIK112233', 'name' => 'Budi Santoso']);
        $this->assertDatabaseHas('tbl_guru', ['nik' => 'NIK998866', 'name' => 'Siti Rahayu']);

        $csvSiswaContent = "Nama Siswa,NISN,Email,Password\n" .
                           "Andi Saputra,NISN554433,andi@siswa.sch.id,secret789\n" .
                           "Dewi Lestari,NISN221100,dewi@siswa.sch.id,secret321\n";

        $fileSiswa = \Illuminate\Http\UploadedFile::fake()->createWithContent('import_siswa.csv', $csvSiswaContent);

        $responseSiswa = $this->actingAs($admin, 'admin')->post(route('admin.siswa.import'), [
            'file_excel' => $fileSiswa,
        ]);

        $responseSiswa->assertRedirect(route('admin.dashboard'));
        $this->assertDatabaseHas('tbl_siswa', ['nisn' => 'NISN554433', 'name' => 'Andi Saputra']);
        $this->assertDatabaseHas('tbl_siswa', ['nisn' => 'NISN221100', 'name' => 'Dewi Lestari']);
    }

    public function test_dedicated_pages_admin_dapat_diakses(): void
    {
        $admin = Admin::firstOrCreate(
            ['username' => 'admin'],
            ['name' => 'Administrator', 'password' => Hash::make('password')]
        );

        $this->actingAs($admin, 'admin')->get('/admin/guru')->assertStatus(200)->assertInertia(fn ($p) => $p->component('Admin/Guru')->has('daftarGuru'));
        $this->actingAs($admin, 'admin')->get('/admin/materi')->assertStatus(200)->assertInertia(fn ($p) => $p->component('Admin/Materi')->has('daftarMateri'));
        $this->actingAs($admin, 'admin')->get('/admin/siswa')->assertStatus(200)->assertInertia(fn ($p) => $p->component('Admin/Siswa')->has('daftarSiswa'));
        $this->actingAs($admin, 'admin')->get('/admin/cms')->assertStatus(200)->assertInertia(fn ($p) => $p->component('Admin/Cms')->has('landingSettings'));
    }

    public function test_dedicated_pages_guru_dapat_diakses(): void
    {
        $guru = Guru::first();

        $this->actingAs($guru, 'guru')->get('/guru/siswa')->assertStatus(200)->assertInertia(fn ($p) => $p->component('Guru/Siswa')->has('siswa'));
        $this->actingAs($guru, 'guru')->get('/guru/materi')->assertStatus(200)->assertInertia(fn ($p) => $p->component('Guru/Materi')->has('materi'));
    }

    public function test_dedicated_pages_siswa_dapat_diakses(): void
    {
        $siswa = Siswa::first();

        $this->actingAs($siswa, 'siswa')->get('/siswa/materi')->assertStatus(200)->assertInertia(fn ($p) => $p->component('Siswa/Materi')->has('materi'));
        $this->actingAs($siswa, 'siswa')->get('/siswa/rapor')->assertStatus(200)->assertInertia(fn ($p) => $p->component('Siswa/Rapor')->has('nilai'));
    }
}
