<?php

namespace App\Http\Actions\User;

use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditProfileRequest;


class EditProfileAction
{
    use ApiResponses;

    public function execute(EditProfileRequest $request, User $user): bool
    {
        return $this->updateProfile($request, $user);
    }

    private function updateProfile($payload, User $user): bool
    {
        $user = $user->update([
            'first_name' => $payload->first_name,
            'last_name' => $payload->last_name,
            'address' => $payload->address,
            'avatar' => $payload->avatar,
            'phone_number' => $payload->phone_number,
            'is_marketing' => ($payload->is_marketing) ? $payload->is_marketing : false,
            'email' => $payload->email,
            'password' => Hash::make($payload->password),
        ]);

        abort_if(!$user, $this->badRequestAlert('Unable to update user. Please try again.'));

        return $user;
    }
}
