<?php

namespace App\Http\Controllers\Auth;

use App\Http\Actions\Auth\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;

class RegistrationController extends Controller
{
   
    public function register(RegisterUserRequest $request )
    {
        return (new RegisterUserAction())->execute($request);
    }
}
