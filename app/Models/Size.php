<?php

namespace App\Models;

use App\Traits\HasAddedbyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory,
        HasAddedbyTrait,
        SoftDeletes;

    const UNITS = ['INCHES', 'METRES', 'CENTIMETRES'];

    protected $fillable = [
        'width',
        'height',
        'breadth',
        'units',
    ];
}
