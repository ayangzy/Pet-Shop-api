<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteUserController extends Controller
{
    use ApiResponses;
    /**
     * @OA\Delete(
     * path="/api/v1/user",
     * operationId="DeleteUser",
     * security={{"bearer_token": {}}},
     * tags={"User"},
     * summary="User delete account",
     * description="User delete account",
     *      @OA\Response(
     *          response=200,
     *          description="User deleted successfully.",
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
    public function delete(): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->find(Auth::id());
        $user->delete();
        Auth::logout();

        return $this->successResponse('User account deleted successfully');

    }
}
