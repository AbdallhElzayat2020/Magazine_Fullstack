<?php

    use App\Http\Controllers\Admin\AdminAuthController;
    use App\Http\Controllers\Admin\DashboardController;
    use Illuminate\Support\Facades\Route;


    Route::group([ 'prefix' => 'admin' , 'as' => 'admin.' ] , function () {
        Route::get('login' , [ AdminAuthController::class , 'login' ])->name('login'); //admin.login
        Route::post('login' , [ AdminAuthController::class , 'handleLogin' ])->name('handle-login'); //admin.handle-login
        Route::post('logout' , [ AdminAuthController::class , 'logout' ])->name('logout'); //admin
        // forgot password
        Route::get('forgot-password' , [ AdminAuthController::class , 'forgotPassword' ])->name('forgot-password');
        Route::post('forgot-password' , [ AdminAuthController::class , 'sendResetLink' ])->name('forgot-password.send');
        Route::get('reset-password/{token}' , [ AdminAuthController::class , 'resetPassword' ])->name('reset-password');
    });

    Route::group([ 'prefix' => 'admin' , 'as' => 'admin.' , 'middleware' => [ 'admin' ] ] , function () {
        Route::get("dashboard" , [ DashboardController::class , "index" ])->name('dashboard');
    });
