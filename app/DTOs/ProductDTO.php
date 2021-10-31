<?php

namespace App\DTOs;

use App\Models\Product;
use App\Models\User;
use App\Traits\DTOTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductDTO
{
    use DTOTrait;

    public ?Product $product = null;
    public ?string $productId = null;
    public ?string $name = null;
    public ?string $description = null;
    public ?object $sizeDetails = null;
    public ?string $sizeId = null;
    public ?array $uses = null;
    public ?string $type = null;
    public ?bool $public = null;
    public ?User $user = null;
    public ?Model $addedby = null;
    public ?string $addedbyType = null;
    public ?string $addedbyId = null;
    public ?array $files = [];

    protected $dtoExclude = ['addedbyId', 'addedbyType', 'files'];

    public function createFromRequestExtension(Request $request) {
        $this->addedbyId = $request->accountId;
        $this->addedbyType = $request->accountType;
        $this->files = $request->file('images', []);

        return $this;
    }
}
