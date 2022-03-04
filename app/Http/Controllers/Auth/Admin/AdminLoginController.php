<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Traits\ApiResponses;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Actions\Auth\Admin\AdminLoginAction;

class AdminLoginController extends Controller
{
    use ApiResponses;
    /**
     * @OA\Post(
     * path="/api/v1/admin/login",
     * operationId="Login",
     * tags={"Admin"},
     * summary="Login an admin account",
     * description="Admin Login here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password"},
     *               @OA\Property(property="email", type="password"),
     *               @OA\Property(property="password", type="password"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
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

    public function adminLogin(
        LoginRequest $request,
        AdminLoginAction $loginAction
    ): \Illuminate\Http\JsonResponse {
        $user = $loginAction->execute($request);

        return $this->successResponse('Admin logged In successfully', $user);
    }
}
