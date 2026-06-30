<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_name',
        'waris_name',
        'email',
        'phone',
        'address',
        'verification_status',
        'additional_info'
    ];

    protected $casts = [
        'additional_info' => 'array',
    ];
}
