<?php

namespace App\Http\Actions\Auth\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use App\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class AdminLoginAction
{
    use ApiResponses;

    public function execute(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth()->attempt($credentials)) {

                abort($this->unauthorisedRequestAlert('Login credentials are invalid'));
            }

            $user = $this->findUser($request);

            $authUser = [
                'email' => $user->email,
                'token' => $token,
            ];
            $this->updateUserLog($user);
            $this->updateOrCreateJwtToken($user);
            return  $authUser;
        } catch (JWTException $exception) {
            logger('Unable to create token.', [$exception->getMessage()]);
        }
    }


    private function findUser($request)
    {
        $user = User::where('email', $request->email)->first();
        abort_if($user && $user->is_admin === 0, $this->unauthorisedRequestAlert('Access denied for this user'));
        return $user;
    }


    /**
     * @param User $user
     */
    private function updateUserLog(User $user)
    {
        return $user->update([
            'last_login_at' => now(),
        ]);
    }


    /**
     * @param User $user
     * 
     * @return object
     */
    private function updateOrCreateJwtToken(User $user): object
    {
        $jwtToken = $user->jwtToken()->updateOrCreate(
            ['user_id' => $user->id,],
            [
                'unique_id' => Str::uuid(),
                'token_title' => "User login authentication",
            ]
        );

        return $jwtToken;
    }
}
