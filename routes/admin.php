<?php

    use App\Http\Controllers\Admin\AdminAuthController;
    use Illuminate\Support\Facades\Route;


    Route::get('admin/login' , [ AdminAuthController::class , 'login' ])->name('admin.auth');
