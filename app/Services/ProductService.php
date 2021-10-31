<?php

namespace App\Services;

use App\DTOs\ProductDTO;
use App\DTOs\SizeDTO;
use App\Exceptions\ProductException;
use App\Models\Product;
use App\Traits\ServiceTrait;

class ProductService
{
    use ServiceTrait;

    public function createProduct(ProductDTO $productDTO)
    {
        $productDTO = $this->setAddedby($productDTO);

        $this->ensureUserHasAccess($productDTO);

        $productDTO = $this->setSizeId($productDTO);

        $productDTO =  $productDTO->withProduct($this->makeProduct($productDTO));

        $productDTO = $this->attachFilesToProduct($productDTO);

        return $productDTO->product;
    }

    private function setSizeId(ProductDTO $productDTO)
    {
        if ($productDTO->sizeId) {
            return $productDTO;
        }
        
        $productDTO = $productDTO->addData([
            'sizeId' => (new SizeService)->createSize(
                SizeDTO::new()->addData($productDTO->sizeDetails)
            )->id
        ]);

        return $productDTO;
    }

    private function attachFilesToProduct(ProductDTO $productDTO)
    {
        $productDTO = $productDTO->withProduct(
            FileService::saveUploadedFilesAndAttachToItem($productDTO->files, $productDTO->product)
        );

        return $productDTO;
    }

    private function makeProduct(ProductDTO $productDTO)
    {
        return $productDTO->addedby->createProduct([
            'name' => $productDTO->name,
            'description' => $productDTO->description,
            'uses' => $productDTO->uses,
            'size_id' => $productDTO->sizeId,
            'type' => $this->getType($productDTO->type),
        ]);
    }

    private function getType($type)
    {
        $type = strtoupper($type);

        if (in_array($type, Product::TYPES)) {
            return $type;
        }

        return Product::ENVELOPE;
    }

    private function setAddedby(ProductDTO $productDTO)
    {
        return $productDTO->withAddedby(
            $this->getModel($productDTO->addedbyType, $productDTO->addedbyId)
        );
    }

    private function ensureUserHasAccess(ProductDTO $productDTO)
    {
        if ($productDTO->addedbyType === 'user') {
            return;
        }

        if ($productDTO->addedby->isOwnedBy($productDTO->user) ||
            $productDTO->addedby->hasUserAsAdmin($productDTO->user)) {
            return;
        }

        $this->throwException(
            "sorry 😞! you do not have access to the company with name: {$productDTO->addedby->name}",
            $productDTO
        );
    }

    private function throwException($message, $data)
    {
        throw new ProductException(
            message: $message,
            data: $data
        );
    }
}
