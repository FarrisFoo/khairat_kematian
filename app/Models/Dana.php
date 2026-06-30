<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah',
        'kaedah_bayaran',
        'resit_path',
        'nama_ahli',
        'status'
    ];

    // app/Models/User.php
    public function dana()
    {
        return $this->hasMany(Dana::class);
    }
}
