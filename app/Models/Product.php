<?php

namespace App\Models;

use App\Traits\HasAddedbyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,
        SoftDeletes,
        HasAddedbyTrait;

    public const TYPES = ['ENVELOPE', 'PAPER_BAG'];
    public const PAPER_BAG = 'PAPER_BAG';
    public const ENVELOPE = 'ENVELOPE';

    protected $fillable = [
        'uses', 
        'description', 
        'name', 
        'size_id',
        'type',
    ];

    public function size()
    {
        return $this->hasOne(Size::class);
    }
}
