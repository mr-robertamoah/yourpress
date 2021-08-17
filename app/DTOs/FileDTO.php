<?php

namespace App\DTOs;

use App\Traits\DTOTrait;

class FileDTO
{
    use DTOTrait;

    public ?string $type = 'image';
    public ?string $fileId = null;
}
