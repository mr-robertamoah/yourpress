<?php

namespace App\Services;

use App\DTOs\SizeDTO;
use App\Traits\ServiceTrait;

class SizeService
{
    use ServiceTrait;

    public static function getSizeWithId($sizeId, $throwException = true)
    {
        return (new static)->getModel('size', $sizeId, $throwException);
    }

    public function createSize(SizeDTO $sizeDTO)
    {
        return $sizeDTO->addedby->createSizes(
            $sizeDTO->getData()
        );
    }
}
