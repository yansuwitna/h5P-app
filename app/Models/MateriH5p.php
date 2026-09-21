<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriH5p extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_materi_h5p';

    protected $fillable = ['judul', 'lokasi_file', 'nama_folder', 'guru_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function daftarNilai()
    {
        return $this->hasMany(Nilai::class, 'materi_id');
    }
}
