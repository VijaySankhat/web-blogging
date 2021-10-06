<?php

use Illuminate\Support\Facades\Route;

Route::resource('posts', PostController::class);
Route::post('posts/import', [\App\Http\Controllers\Admin\PostController::class, 'importPosts'])->name('posts.import');
Route::get('posts/import/status/{user_imports}', [\App\Http\Controllers\Admin\PostController::class, 'importStatus'])->name('posts.import.status');