<?php

    use Illuminate\Support\Facades\Route;



    Route::get('/admin' , function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard.index');
