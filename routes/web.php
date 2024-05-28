<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LoginWithGoogleController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::post('/setlang/{locale}',[\App\Http\Controllers\LanguageController::class, 'change_language'])->name('cahange_l');
Route::post('/password_request', [\App\Http\Controllers\PasswordResetController::class, 'password_reset_email'])->name('password.request');
Route::get('/password_request', [\App\Http\Controllers\PasswordResetController::class, 'password_request_blade'])->name('password.req');
Route::post('/password_reset_confirmation', [\App\Http\Controllers\PasswordResetController::class, 'password_reset_confirmation'])
    ->name('password.reset.confirmation');
Route::get('/reset-password/{token}', function (string $token) {return view('password_reset.reset-password', ['token' => $token]);})
    ->name('password.reset');
Route::get('/', function () {return view('contents.fooldal');})->name('home');
Route::get('/helytortenet', function () {return view('contents.helytortenet');})->name('helytortenet');
Route::get('/egyhaz', function () {return view('contents.egyhaz');})->name('egyhaz');
Route::get('/galleria/{type}', [\App\Http\Controllers\ImageController::class, 'show'])->name('kepek');
Route::get('/contact', [\App\Http\Controllers\CommentsController::class, 'index'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\CommentsController::class, 'search'])->name('search_contact');
Route::get('/our_news', [\App\Http\Controllers\NewsController::class, 'create'])->name('news');
Route::get('authorized/google', [LoginWithGoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('authorized/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::middleware('guest')->group(function(){
    Route::get('/login', [\App\Http\Controllers\SessionsController::class, 'create'])->name('login');
    Route::post('/login', [\App\Http\Controllers\SessionsController::class, 'store'])->name('inlogin');
    Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'create'])->name('register');
    Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'store'])->name('inregister');
});
Route::middleware('auth')->group(function(){
    Route::post('comment/delete', [\App\Http\Controllers\CommentsController::class, 'delete'])->name('delete_comment');
    Route::post('logout', [\App\Http\Controllers\SessionsController::class, 'destroy'])->name('logout');
    Route::post('comment/store', [\App\Http\Controllers\CommentsController::class, 'store'])->name('comment.save');
    Route::post('comment/like', [\App\Http\Controllers\CommentsController::class, 'like'])->name('comment.like');
    Route::post('comment/dislike', [\App\Http\Controllers\CommentsController::class, 'dislike'])->name('comment.dislike');
    Route::get('user/editor', [\App\Http\Controllers\UserController::class, 'index'])->name('user.edit');
    Route::post('user/edit/mail', [\App\Http\Controllers\UserController::class, 'change_email'])->name('user.edit.email');
    Route::post('user/edit/name', [\App\Http\Controllers\UserController::class, 'change_name'])->name('user.edit.name');
    Route::post('user/edit/password', [\App\Http\Controllers\UserController::class, 'change_password'])->name('user.edit.password');
    Route::get('user/edit/delete', [\App\Http\Controllers\UserController::class, 'delete_user'])->name('user.edit.delete');
    Route::post('/admin/store_news', [\App\Http\Controllers\NewsController::class, 'news_store'])->name('new.store');

    Route::middleware('can:admin')->group(function(){
        Route::post('/image/store', [\App\Http\Controllers\ImageController::class, 'upload'])->name('image.store');
        Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin');
        Route::post('/admin/{comment}', [\App\Http\Controllers\AdminController::class, 'delete_comment'])->name('delete_comment_admin');
        Route::delete('/admin/{media}', [\App\Http\Controllers\AdminController::class, 'delete_image'])->name('delete_img_admin');
        Route::post('/admin/accept/{comment}', [\App\Http\Controllers\AdminController::class, 'accept_comment'])->name('accept.comment');
        Route::post('/admin/bann/{user}', [\App\Http\Controllers\AdminController::class, 'bann_user'])->name('bann_user_admin');
        Route::post('/admin/unlock/{user}', [\App\Http\Controllers\AdminController::class, 'unlock_user'])->name('unlock_user_admin');
        Route::get('/admin/news', [\App\Http\Controllers\NewsController::class, 'news_admin'])->name('news.admin');
        Route::get('/admin/delete_news/{new}', [\App\Http\Controllers\NewsController::class, 'news_delete'])->name('new.delete');
    });
});

