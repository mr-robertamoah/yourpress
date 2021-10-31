<?php

namespace App\Traits;

use App\Models\Product;

trait AddProductTrait
{
    public function createProduct(array $data)
    {
        return $this->products()->create($data);
    }

    public function products()
    {
        return $this->morphMany(Product::class, 'addedby');
    }
}
