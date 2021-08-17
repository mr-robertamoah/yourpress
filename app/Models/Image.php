<?php

namespace App\Models;

use App\Traits\HasAddedbyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory,
        HasAddedbyTrait;

    protected $fillable = [
        'name', 'path', 'mime'
    ];
}
