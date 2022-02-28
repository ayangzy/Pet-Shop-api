<?php

namespace App\Http\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use App\Models\PasswordReset;
use App\Mail\ForgotPasswordMailable;
use Illuminate\Support\Facades\Mail;
use App\Jobs\PasswordResetNotification;
use App\Http\Requests\ForgotPasswordRequest;

class ForgotPasswordAction
{
    use ApiResponses;
    
    public function execute(ForgotPasswordRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            abort($this->notFoundAlert('Account could not be found.'));
        }

        $tokenData = PasswordReset::create([
            'email' => $user->email,
            'token' => $this->generateToken(),
            'created_at' => now()
        ]);

        Mail::to($user->email)->send(new ForgotPasswordMailable($user, $tokenData->token));

        return $tokenData;

        
    }


    /**
     * @return string
     */
    private function generateToken(): string
    {
        return strtoupper(Str::random(6));
    }

  
}