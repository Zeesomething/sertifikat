<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'id' ,
        'nama_training' ,
        'tanggal_mulai' ,
        'tanggal_selesai' ,
        'konten' ,
        'cover'
    ];
    public $timestamps = true;

    // relasi ke tabel sertifikat
    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class);
    }

    //menghapus img
    public function deleteImage()
    {
        if ($this->cover && file_exists(public_path('images/training' . $this->cover))) {
            return unlink(public_path('images/training' . $this->cover));
        }
    }

}
