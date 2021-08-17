<?php

namespace App\DTOs;

use App\Traits\DTOTrait;

class UserDTO
{
    use DTOTrait;

    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $otherNames = null;
    public ?string $password = null;
    public ?string $username = null;
    public ?string $email = null;

    private function createFromRequestExtension($request)
    {
        ray($this)->green();
        return $this;
    }
}
