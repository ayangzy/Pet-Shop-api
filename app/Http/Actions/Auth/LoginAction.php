<?php

namespace App\Http\Actions\Auth;

use App\Models\User;
use App\Traits\ApiResponses;
use App\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;


class LoginAction
{
    use ApiResponses;

    public function execute(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth()->attempt($credentials)) {
                
                abort($this->unauthorisedRequestAlert('Authentication failed'));
            }

            $user = $this->findUser($request);

            $authUser = [
                'email' => $user->email,
                'token' => $token,
            ];
            $this->updateUserLog($user);
            return  $authUser;
        } catch (JWTException $exception) {
            logger('An error occred processsing request', [$exception->getMessage()]);
        }
    }


    private function findUser($request)
    {
        $user = User::where('email', $request->email)->first();
        abort_if($user && $user->is_admin === 1, $this->unauthorisedRequestAlert('Access denied for this user'));
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
}
