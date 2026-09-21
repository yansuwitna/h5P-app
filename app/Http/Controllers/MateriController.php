<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MateriH5p;
use App\Models\Nilai;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    public function unggah(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file_h5p' => 'required|file|mimes:zip,h5p'
        ]);

        $file = $request->file('file_h5p');
        $namaFolder = 'h5p_' . time() . '_' . Str::random(5);
        
        $disk = env('H5P_STORAGE_DISK', 'local');
        
        $path = $file->storeAs("materi_unggahan/{$namaFolder}", "materi.h5p", $disk);

        MateriH5p::create([
            'judul' => $request->judul,
            'lokasi_file' => $path,
            'nama_folder' => $namaFolder,
            'guru_id' => auth()->id(),
        ]);

        return redirect()->back()->with('sukses', 'Materi H5P berhasil diunggah.');
    }

    public function kerjakan($id)
    {
        $materi = MateriH5p::findOrFail($id);
        $disk = env('H5P_STORAGE_DISK', 'local');
        
        $lokasiEkstrakLokal = storage_path("app/public/ekstrak_h5p/{$materi->nama_folder}");
        $urlPublik = asset("storage/ekstrak_h5p/{$materi->nama_folder}");

        if (!file_exists($lokasiEkstrakLokal)) {
            if (!file_exists(storage_path('app/public/ekstrak_h5p'))) {
                mkdir(storage_path('app/public/ekstrak_h5p'), 0777, true);
            }

            $lokasiZipSementara = storage_path("app/temp_{$materi->nama_folder}.zip");
            file_put_contents($lokasiZipSementara, Storage::disk($disk)->get($materi->lokasi_file));

            $zip = new ZipArchive;
            if ($zip->open($lokasiZipSementara) === TRUE) {
                $zip->extractTo($lokasiEkstrakLokal);
                $zip->close();
                unlink($lokasiZipSementara); 
            }
        }

        return view('h5p.play', compact('materi', 'urlPublik'));
    }

    public function simpanNilai(Request $request)
    {
        $request->validate([
            'materi_id' => 'required|exists:tbl_materi_h5p,id',
            'skor' => 'required|numeric',
            'skor_maksimal' => 'required|numeric',
        ]);

        $persentase = ($request->skor / $request->skor_maksimal) * 100;
        $lencana = 'Perunggu';
        if ($persentase >= 90) $lencana = 'Emas';
        elseif ($persentase >= 75) $lencana = 'Perak';

        Nilai::create([
            'siswa_id' => auth()->id(),
            'materi_id' => $request->materi_id,
            'skor' => $request->skor,
            'skor_maksimal' => $request->skor_maksimal,
            'lencana' => $lencana,
        ]);

        return response()->json(['sukses' => true, 'lencana' => $lencana]);
    }
}
