<?php

namespace App\Traits;

trait AddSizeTrait
{
    public function createSize(array $data)
    {
        return $this->sizes()->create($data);
    }

    public function sizes()
    {
        return $this->morphMany(Size::class, 'addedby');
    }
}
