<?php

namespace App\Http\Controllers\Auth;

use App\Http\Actions\Auth\ResetPasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class ResetPasswordTokenController extends Controller
{
    use ApiResponses;

    /**
     * @OA\Post(
     * path="/api/v1/user/reset-password-token",
     * operationId="resetPassword",
     * tags={"User"},
     * summary="Provide token and change your password",
     * description="User Change password",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *               type="object",
     *               required={"token", "email", "password", "password_confirmation"},
     *               @OA\Property(property="token", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="password_confirmation", type="password"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Password reset Successfully",
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

    public function resetPassword(ResetPasswordRequest $request, ResetPasswordAction $resetPasswordAction)
    {

        $resetPasswordAction->execute($request);

        return $this->successResponse('Password reset successfully.');
    }
}
