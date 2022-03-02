<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Traits\ApiResponses;
use App\Http\Controllers\Controller;

class AdminLogoutController extends Controller
{
    use ApiResponses;
    /**
    * @OA\Get(
    * path="/api/v1/admin/logout",
    * operationId="Logout",
    * security={{"bearer_token": {}}},
    * tags={"Admin"},
    * summary="Log out admin account",
    * description="Admin logout here",
    *      @OA\Response(
    *          response=200,
    *          description="Admin logged out successfully.",
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
       return $this->successResponse('Admin logged out successfully');
   }
}
