<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_penerima',
        'id_training',
        'status',
    ];
    public $timestamps = true;
    public function training()
    {
        return $this->belongsTo(Training::class, 'id_training', 'id');
    }

}

// Schema::create('sertifikats', function (Blueprint $table) {
//     $table->id();
//     $table->string('nama_penerima');
//     $table->string('nomor_sertifikat');
//     $table->date('tanggal_mulai');
//     $table->date('tanggal_selesai');
//     $table->unsignedBigInteger('id_training');
//     $table->timestamps();

//     $table->foreign('id_training')->references('id')->on('trainings')->onDelete('cascade');
// });
