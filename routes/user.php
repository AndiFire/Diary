<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\NoteController;
use App\Http\Controllers\Notes\CommentController;


Route::prefix('user')->middleware('auth')->group(function(){

   Route::redirect('/', '/user/notes')->name('user');

   Route::get('notes', [NoteController::class, 'index'])->name('user.notes');
   Route::get('notes/create', [NoteController::class, 'create'])->name('user.notes.create');
   Route::post('notes', [NoteController::class, 'store'])->name('user.notes.store');
   Route::get('notes/{note}', [NoteController::class, 'show'])->name('user.notes.show')->whereNumber('note');
   Route::get('notes/{note}/edit', [NoteController::class, 'edit'])->name('user.notes.edit')->whereNumber('note');
   Route::put('notes/{note}', [NoteController::class, 'update'])->name('user.notes.update')->whereNumber('note');
   Route::delete('notes/{note}', [NoteController::class, 'delete'])->name('user.notes.delete')->whereNumber('note');

   Route::get('/notes/{note}/comments', [CommentController::class, 'index']);
   Route::post('/notes/{note}/comments', [CommentController::class, 'store']);

});

