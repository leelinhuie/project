<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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
    return view('home');
});

//Blog
Route::resource('/blog', PostsController::class);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/like-post/{show}', [App\Http\Controllers\PostsController::class, 'likePost'])->name('post.like')->middleware(['auth']);

Route::post('store', [App\Http\Controllers\CommentController::class, 'store'])->name("comments.store");

//Admin
Route::group(['prefix'=>'admin'], function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::get('help',[AdminController::class,'help'])->name('admin.help');
    Route::get('/showUser',[App\Http\Controllers\UserController::class,'view'])->name('showUser');

    Route::post('profile',[AdminController::class,'updateAvatar'])->name('adminUpdateAvatar');
    Route::post('update-profile-info',[AdminController::class,'updateInfo'])->name('adminUpdateInfo');
    Route::post('change-profile-picture',[AdminController::class,'updatePicture'])->name('adminPictureUpdate');
    Route::post('change-password',[AdminController::class,'changePassword'])->name('adminChangePassword');
});

//User
Route::group(['prefix'=>'user'], function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::get('profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('help',[UserController::class,'help'])->name('user.help');

    Route::post('profile',[UserController::class,'updateAvatar'])->name('userUpdateAvatar');
    Route::post('update-profile-info',[UserController::class,'updateInfo'])->name('userUpdateInfo');
    Route::post('change-profile-picture',[UserController::class,'updatePicture'])->name('userPictureUpdate');
    Route::post('change-password',[UserController::class,'changePassword'])->name('userChangePassword');
    });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
