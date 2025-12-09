<?php

use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Notes\CommentController;
use App\Http\Controllers\User\NoteController;
use App\Http\Controllers\LikeController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// -------------------HOME---------------------
Route::get('/diary', [DiaryController::class, 'index'])->name('diary');
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::redirect('/', '/home')->name('home.redirect');

// --------------------------------------AUTH--------------------------------------------
Route::middleware('auth')->group(function () {

   Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

   Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
   Route::post('/change-password', [UserController::class, 'ChangePassword'])->name('password.change');
   Route::post('/change-name', [UserController::class, 'ChangeName'])->name('name.change');

   Route::get('/email/verify', EmailVerificationPromptController::class)->name('verification.notice');
   Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)->middleware('signed')->name('verification.verify');
   Route::post('/email/verification-notification', EmailVerificationNotificationController::class)->name('verification.send');

   Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
   Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

   Route::get('notes/{note}', [NoteController::class, 'show'])->name('notes.show')->whereNumber('note');

   Route::get('notes/{note}/comments', [CommentController::class, 'index']);
   Route::post('notes/{note}/comments', [CommentController::class, 'store']);

   Route::post('/like', [LikeController::class, 'store'])->name('like.store');
});

//---------------------------------------GUEST---------------------------------------------
Route::middleware('guest')->group(function () {

   Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
   Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest')->name('register.store');

   Route::get('/login', [AuthenticatedSessionController::class, 'index'])->middleware('guest')->name('login');
   Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest')->name('login.store');

   Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
   Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

   Route::get('/reset-password', [NewPasswordController::class, 'create'])->name('password.reset');
   Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

   Route::get('/reset-password', [NewPasswordController::class, 'create'])->name('password.reset');
   Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

});








