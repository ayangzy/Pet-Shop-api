<?php

namespace App\Http\Controllers\Auth;

use App\Traits\ApiResponses;
use App\Http\Actions\Token\JwtToken;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegisterResource;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Actions\Auth\RegisterUserAction;

class RegistrationController extends Controller
{
    use ApiResponses;
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Pet Shop Api",
     *      description="L5 Swagger OpenApi description",
     * ),
     * @OA\Post(
     * path="/api/v1/user/create",
     * operationId="Register",
     * tags={"User"},
     * summary="Create a user account",
     * description="User Registration",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *               type="object",
     *               required={"first_name", "last_name", "email", "password", "password_confirmation", "address", "phone_number"},
     *               @OA\Property(property="first_name", type="text"),
     *               @OA\Property(property="last_name", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="password_confirmation", type="password"),
     *               @OA\Property(property="avatar", type="text"),
     *               @OA\Property(property="address", type="text"),
     *               @OA\Property(property="phone_number", type="text"),
     *               @OA\Property(property="is_marketing", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="User registration created successfully",
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

    public function register(RegisterUserRequest $request, RegisterUserAction $registrationAction)
    {
        $user = $registrationAction->execute($request);
        $user->token = $this->generateToken($user);
        return $this->createdResponse('User registration created successfully', new RegisterResource($user));
    }
}
