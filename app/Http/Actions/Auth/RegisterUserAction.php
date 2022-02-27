<?php

namespace App\Http\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\RegisterResource;

class RegisterUserAction
{
    use ApiResponses;

    public function execute(RegisterUserRequest $request)
    {
        $user = $this->saveDetails($request);

        if (!$user) {
            return $this->badRequestAlert('User could not be created, please retry');
        }

        return $user;
    }

    private function saveDetails($payload)
    {
        return User::create([
            'first_name' => $payload->first_name,
            'last_name' => $payload->last_name,
            'email' => $payload->email,
            'phone_number' => $payload->phone_number,
            'address' => $payload->address,
            'avatar' => $payload->avatar,
            'is_marketing' => ($payload->is_marketing) ? $payload->is_marketing : 0,
            'uuid' => Str::uuid(),
            'password' => Hash::make($payload->password),
        ]);
    }
}
