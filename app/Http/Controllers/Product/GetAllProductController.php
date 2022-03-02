<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Traits\ApiResponses;
use App\Http\Actions\ListActions;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class GetAllProductController extends Controller
{
    use ApiResponses;

    /**
     * @OA\Get(
     * path="/api/v1/products",
     * operationId="allProducts",
     * tags={"Products"},
     * summary="List all products",
     * description="List all products",
     *      @OA\Parameter(
     *           name="page",
     *           in="query",
     *           @OA\Schema(
     *           type="integer"
     *       )
     *       ),
     *      @OA\Parameter(
     *           name="limit",
     *           in="query",
     *           @OA\Schema(
     *           type="integer"
     *       )
     *       ),
     *      @OA\Parameter(
     *           name="sortBy",
     *           in="query",
     *           @OA\Schema(
     *           type="string"
     *       )
     *       ),
     *      @OA\Parameter(
     *           name="desc",
     *           in="query",
     *           @OA\Schema(
     *           type="boolean"
     *       )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Products retrieved successfully",
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
    public function index()
    {
        $products = (new ListActions(Product::class, 'products'))->sortWithoutAuth();

        return $this->successResponse('Products retreived successfully.', [
            'product' => ProductResource::collection($products),
            'first_page_url' => $products->url(1),
            'from' => $products->firstItem(),
            'per_page' => $products->perPage(),
            'prev_page_url' => $products->previousPageUrl(),
            'next_page_url' => $products->nextPageUrl(),
            'last_page' => $products->lastPage(),
            'to' => $products->lastItem(),
            'total' => $products->total(),
        ]);
    }
}
