<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\OrderListController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\EditProfileController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Admin\AdminListUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\Admin\AdminLoginController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\GetAllProductController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\Auth\ResetPasswordTokenController;
use App\Http\Controllers\Product\GetSingleProductController;

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
    
    Route::prefix('admin')->group(function () {
        Route::post('/login', [AdminLoginController::class, 'adminLogin'])->name('adminLogin');
        Route::get('/user-listing', [AdminListUserController::class, 'listUser'])->name('listUser')->middleware('is_admin');
    });

    Route::group(['middleware' => ['jwt.verify', 'is_admin']], static function () {
        Route::prefix('/product')->name('product.')->group(function () {
            Route::post('/create', [CreateProductController::class, 'store'])->name('create');
            Route::put('/{uuid}', [UpdateProductController::class, 'update'])->name('update');
            Route::delete('/{uuid}', [DeleteProductController::class, 'delete'])->name('delete');
        });
    });

    Route::get('/products', [GetAllProductController::class, 'index'])->name('product.index');
    Route::get('/product/{uuid}', [GetSingleProductController::class, 'show'])->name('product.show');
   

});
