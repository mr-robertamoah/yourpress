<?php

namespace App\Traits;

trait HasAddedbyTrait
{
    public function addedby()
    {
        return $this->morphTo();
    }
}
