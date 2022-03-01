<?php


namespace Tests;


use App\Models\AuthorizationRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait TestStub
{
    /**
     * @return MakesHttpRequests
     */
    public function asAuthorisedUser()
    {
        $password = 'password';
        $user = User::factory([
            'password' => Hash::make($password)
        ])->create();
        $token = Auth::guard('api')->attempt([
            'email' => $user->email,
            'password' => $password
        ]);
        
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ]);
    }
}
