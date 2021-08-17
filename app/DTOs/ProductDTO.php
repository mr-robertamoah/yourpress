<?php

namespace App\DTOs;

use App\Models\Product;
use App\Traits\DTOTrait;

class ProductDTO
{
    use DTOTrait;

    public ?Product $product = null;
    public ?string $productId = null;
}
