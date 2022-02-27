<?php

namespace App\Http\Actions\Token;

use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtToken
{
    use ApiResponses;
    /**
     * @param User $user
     * 
     * @return string
     */
    public function token(User $user): string
    {
        $token = JWTAuth::fromUser($user);
        $authenticate = JWTAuth::setToken($token)->toUser();

        if (!$authenticate) {
            return $this->unauthorisedRequestAlert('Authentication failed');
        }
        $this->updateOrCreateJwtToken($authenticate);

        return $token;
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
                'token_title' => "User Authentication"
            ]
        );

        return $jwtToken;
    }
}
