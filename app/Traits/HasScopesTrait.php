<?php

namespace App\Traits;

trait HasScopesTrait
{
    public function scopes()
    {
        return $this->morphToMany(Scope::class, 'scopeable', 'scopeables');
    }
}
