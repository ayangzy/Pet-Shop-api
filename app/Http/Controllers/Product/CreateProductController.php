<?php

namespace App\Http\Controllers\Product;

use App\Traits\ApiResponses;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\CreateProductRequest;
use App\Http\Actions\Product\CreateProductAction;

class CreateProductController extends Controller
{
    use ApiResponses;
   /**
     * @OA\Post(
     * path="/api/v1/product/create",
     * operationId="CreateProduct",
     * security={{"bearer_token": {}}},
     * tags={"Products"},
     * summary="Create New Product",
     * description="Create new Product",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *               type="object",
     *               required={"category_uuid", "title", "price", "description", "metadata"},
     *               @OA\Property(property="category_uuid", type="text"),
     *               @OA\Property(property="title", type="text"),
     *               @OA\Property(property="price", type="number"),
     *               @OA\Property(property="description", type="text"),
     *               @OA\Property(property="metadata", type="object", example={"image":"string","brand": "string"}),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Product created successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(CreateProductRequest $request, CreateProductAction $createProductAction)
    {
        $product = $createProductAction->execute($request);

        return $this->createdResponse('Product Created successfully', new ProductResource($product));
    }
}
