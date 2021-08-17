<?php

namespace App\Models;

use App\Traits\HasAddedbyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneNumber extends Model
{
    use HasFactory,
        SoftDeletes,
        HasAddedbyTrait;
    
    protected $fillable = [
        'verified_at', 'digits',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];
}
