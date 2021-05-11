<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_urut', 'nama_ketua', 'nama_wakil', 'jurusan', 'rekam_jejak', 'visi', 'misi', 'image'
    ];
}
