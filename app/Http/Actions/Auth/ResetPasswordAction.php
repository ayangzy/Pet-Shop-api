<?php

namespace App\Http\Actions\Auth;

use App\Models\User;
use App\Traits\ApiResponses;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetPasswordRequest;

class ResetPasswordAction
{
    use ApiResponses;

    public function execute(ResetPasswordRequest $request)
    {
        /**
         * This method is to reset user's password.
         *
         * @param \App\Http\Requests\Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         *
         * @throws \Exception
         */

        $userToken = PasswordReset::where('token', $request->token)
            ->where('email', $request->email)->first();

        if (!$userToken) {

            abort($this->notFoundAlert('Invalid token.'));
        }

        if (!$userToken->isExpired()) {

            abort($this->badRequestAlert('Token is expired'));
        }

        $user = User::where('email', $request->email)->first();

        $password = Hash::make($request->password);

        $user->update(['password' => $password]);

        $userToken->delete();

        return $user;
    }
}
