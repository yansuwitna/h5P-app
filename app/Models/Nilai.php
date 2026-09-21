<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'tbl_nilai';

    protected $fillable = ['siswa_id', 'materi_id', 'skor', 'skor_maksimal', 'lencana'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function materi()
    {
        return $this->belongsTo(MateriH5p::class, 'materi_id');
    }
}
