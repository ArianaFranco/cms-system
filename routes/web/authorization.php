<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        
        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::resource('permissions', App\Http\Controllers\PermissionController::class);
        
    });
    
    
    Route::put('roles/{role}/attach', [\App\Http\Controllers\RoleController::class, 'attachPermission'])
         ->name('roles.permission.attach');
    
    Route::put('roles/{role}/detach', [\App\Http\Controllers\RoleController::class, 'detachPermission'])
         ->name('roles.permission.detach');
    
});



