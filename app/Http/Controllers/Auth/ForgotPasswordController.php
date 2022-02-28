<?php

namespace App\Http\Controllers\Auth;

use App\Http\Actions\Auth\ForgotPasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    use ApiResponses;
    
    public function forgotPassword(ForgotPasswordRequest $request, ForgotPasswordAction $forgotPasswordAction)
    {
        $forgotPasswordAction->execute($request);

        $message = 'A token has been sent to this email address to reset your password';

        return $this->successResponse($message);

    }
}
