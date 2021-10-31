<?php

namespace App\DTOs;

use App\Models\Size;
use App\Traits\DTOTrait;
use Illuminate\Database\Eloquent\Model;
use ReflectionObject;

class SizeDTO
{
    use DTOTrait;

    public ?string $sizeId = null;
    public ?Size $size = null;
    public ?int $width = null;
    public ?int $breadth = null;
    public ?int $height = null;
    public ?Model $addedby = null;
    public ?string $units = null;

    protected $dtoKeys = ['width', 'breadth', 'height', 'units'];
}
