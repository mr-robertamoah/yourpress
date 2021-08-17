<?php

namespace App\Models;

use App\Traits\HasAddedbyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,
        SoftDeletes,
        HasAddedbyTrait;

    protected $fillable = [
        'name', 
        'description', 
        'start_date', 
        'end_date', 
        'product_id', 
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
