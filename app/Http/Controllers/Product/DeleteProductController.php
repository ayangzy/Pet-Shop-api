<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;

class DeleteProductController extends Controller
{
    use ApiResponses;
    /**
     * @OA\Delete(
     * path="/api/v1/product/{uuid}",
     * operationId="deleteProduct",
     * security={{"bearer_token": {}}},
     * tags={"Products"},
     * summary="Delete specific product",
     * description="Delete specific product",
     *      @OA\Parameter(
     *           name="uuid",
     *           in="path",
     *           @OA\Schema(
     *           type="string"
     *       )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Product deleted successfully product",
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
    public function delete($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        if(!$product){
            return $this->badRequestAlert('Product not found');
        }
        $product->delete();

        return $this->successResponse('Product deleted successfully');
    }
}
