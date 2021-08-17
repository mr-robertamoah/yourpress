<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = ['type'];

    const TYPES = [
        'SUPERADMIN',
        'SUPERVISOR',
        'ADMIN',
    ];

    public function adminable()
    {
        return $this->morphTo();
    }
}
