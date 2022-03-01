<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Traits\ApiResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderListResource;

class OrderListController extends Controller
{
    use ApiResponses;
    /**
     * @OA\Get(
     * path="/api/v1/user/orders",
     * operationId="userOrders",
     * security={{"bearer_token": {}}},
     * tags={"User"},
     * summary="List all orders for the user",
     * description="User Logout here",
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
     *          description="Order listed successfully",
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
    public function show()
    {
        $orders = Order::with(['orderStatus', 'payment'])->where('user_id', Auth::id())->paginate(10);
        $userOrderResource = OrderListResource::collection($orders);
        $orders->data = $userOrderResource;
        return $this->successResponse('User orders retrieved successfully', $orders);
    }
}
