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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function(){
    //Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    //Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');
    
    Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::resource('admin', App\Http\Controllers\AdminController::class);
    
    Route::resource('posts', App\Http\Controllers\PostController::class)->except([
        'index', 'show'
    ]);
    
    
    Route::middleware('role:admin')->group(function() {
        Route::resource('users', App\Http\Controllers\UserController::class)->only([
            'index'
        ]);
        
    });
    
    
    Route::middleware(['can:view,user'])->group(function() {
        
        Route::resource('users', App\Http\Controllers\UserController::class)->except([
            'index'
        ]);
    
        Route::put('users/{user}/attach', [\App\Http\Controllers\UserController::class, 'attachRole'])
             ->name('users.role.attach');
            
        Route::put('users/{user}/detach', [\App\Http\Controllers\UserController::class, 'detachRole'])
             ->name('users.role.detach');
        
    });
    
    
    Route::post('image-destroy', [\App\Http\Controllers\ImageController::class, 'destroy'])->name('images.destroy');
    Route::resource('images-upload', App\Http\Controllers\ImageController::class);
    Route::get('getImages', [\App\Http\Controllers\ImageController::class, 'getImages'])->name('getImages');
});

Route::resource('posts', App\Http\Controllers\PostController::class)->only([
    'index', 'show'
]);



//Using Policy as a middleware
//->middleware('can:view, post');
//->middleware('can:view, user');