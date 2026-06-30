<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuntutan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ahli',
        'nama_tuntutan',
        'email',
        'phone',
        'jumlah_dituntut',
        'jumlah_diluluskan',
        'sijil_kematian_path',
        'status',
    ];

}
