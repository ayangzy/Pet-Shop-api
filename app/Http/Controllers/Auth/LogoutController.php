<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    use ApiResponses;
     /**
     * @OA\Get(
     * path="/api/v1/user/logout",
     * operationId="Logout",
     * security={{"bearer_token": {}}},
     * tags={"User"},
     * summary="User Logout",
     * description="User Logout here",
     *      @OA\Response(
     *          response=200,
     *          description="User logged out successfully.",
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
    public function logout()
    {
        auth()->logout();
        return $this->successResponse('User logged out successfully');
    }
}
