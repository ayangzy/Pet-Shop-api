<?php

namespace App\Http\Controllers\Auth;

use App\Traits\ApiResponses;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Actions\Auth\LoginAction;

class LoginController extends Controller
{
    use ApiResponses;
    /**
     * @OA\Post(
     * path="/api/v1/user/login",
     * operationId="Login",
     * tags={"User"},
     * summary="User Login",
     * description="User Login here",
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
     *          description="User logged in successfully",
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

    public function login(LoginRequest $request, LoginAction $loginAction)
    {
        $user = $loginAction->execute($request);
        return $this->successResponse('User loggedIn successfulyy', $user);
    }
}
