<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class GetSingleProductController extends Controller
{
    use ApiResponses;

    /**
     * @OA\Get(
     * path="/api/v1/product/{uuid}",
     * operationId="singleProduct",
     * tags={"Products"},
     * summary="List a product",
     * description="List a product",
     *      @OA\Parameter(
     *           name="uuid",
     *           in="path",
     *           @OA\Schema(
     *           type="string"
     *       )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="List a product",
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
    public function show($uuid): \Illuminate\Http\JsonResponse
    {
        $product = Product::query()->where('uuid', $uuid)->first();

        if (!$product) {
            return $this->notFoundAlert('Product not found');
        }

        return $this->successResponse('Product retreived successfully.', new ProductResource($product));
    }
}
