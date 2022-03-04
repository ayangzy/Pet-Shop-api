<?php

namespace App\Http\Controllers\Auth;

use App\Http\Actions\Auth\ForgotPasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    use ApiResponses;
    /**
     * @OA\Post(
     * path="/api/v1/user/forgot-password",
     * operationId="forgetPassword",
     * tags={"User"},
     * summary="Create token for resetting  Password",
     * description="Request password reset token",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *               type="object",
     *               required={"email"},
     *               @OA\Property(property="email", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="A token has been sent to this email address to reset your password",
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

    public function forgotPassword(ForgotPasswordRequest $request, ForgotPasswordAction $forgotPasswordAction)
    {

        $forgotPasswordAction->execute($request);

        $message = 'A token has been sent to your email address to reset your password';

        return $this->successResponse($message);
    }
}
