<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\OrderListController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\EditProfileController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordTokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function(){

    Route::prefix('user')->name('user.')->group(function(){

        Route::post('/create', [RegistrationController::class, 'register'])->name('register');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
        Route::post('/reset-password-token', [ResetPasswordTokenController::class, 'resetPassword'])->name('resetPassword');

        Route::group(['middleware' => ['jwt.verify', 'is_user']], static function () {
            Route::get('/', [ProfileController::class, 'profile'])->name('profile');
            Route::put('/edit', [EditProfileController::class, 'editProfile'])->name('editProfile');
            Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
            Route::delete('/', [DeleteUserController::class, 'delete'])->name('delete');
            Route::get('/orders', [OrderListController::class, 'show'])->name('order');
        });
    });
    
    
});
