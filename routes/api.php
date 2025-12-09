<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\NoteController;
use App\Http\Controllers\Notes\CommentController;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/notes/{note}/comments', [CommentController::class, 'index']);
    Route::post('/notes/{note}/comments', [CommentController::class, 'store']);
});