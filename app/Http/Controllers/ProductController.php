<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDTO;
use App\Exceptions\ProductException;
use App\Http\Requests\ProductCreationRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(ProductCreationRequest $request)
    {
        try {
            $product = (new ProductService)->createProduct(
                ProductDTO::createFromRequest($request)
            );

            return response()->json([
                'message' => 'successful',
                'product' => new ProductResource($product)
            ]);
        } catch (ProductException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 402);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
