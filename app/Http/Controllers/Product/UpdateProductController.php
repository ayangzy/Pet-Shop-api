<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Actions\Product\UpdateProductAction;

class UpdateProductController extends Controller
{
    use ApiResponses;
     /**
     * @OA\Put(
     * path="/api/v1/product/{uuid}",
     * operationId="updateProduct",
     * security={{"bearer_token": {}}},
     * tags={"Products"},
     * summary="Update an existing product",
     * description="update Product",
     *      @OA\Parameter(
     *           name="uuid",
     *           in="path",
     *           @OA\Schema(
     *           type="string"
     *       )
     *       ),
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
     *          response=200,
     *          description="Product updated successfully",
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
    public function update(UpdateProductRequest $request, UpdateProductAction $updateProductAction, Product $uuid)
    {
        
        $updateProductAction->execute($request, $uuid);
        return $this->successResponse('Product updated successfully', new ProductResource($uuid));
    }
}
