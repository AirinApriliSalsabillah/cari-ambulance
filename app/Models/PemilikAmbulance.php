<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilikAmbulance extends Model
{
    use HasFactory;
    protected $table = "pemilik_ambulance";
    protected $fillable = [
        'id_user',
        'nama_instansi',
        'alamat',
        'nomor_hp',
        'deskripsi',
        'latitude',
        'longitude',
    ];
}
