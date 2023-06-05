<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:api')->group(function () {

  Route::post('/logout', [AuthController::class, 'logout']);
  // NEWS REQUESTs
  Route::get('/news', [NewsController::class, 'index']);
  Route::get('/news/{id}', [NewsController::class, 'show']);
  Route::post('/news', [NewsController::class, 'store']);
  Route::post('/news/{id}', [NewsController::class, 'update']);
  Route::delete('/news/{news}', [NewsController::class, 'destroy']);
  // COMMENTS REQUESTs
  Route::get('/comments', [CommentController::class, 'index']);
  Route::get('/comment/{id}', [CommentController::class, 'show']);
  Route::post('/comment', [CommentController::class, 'store']);
  Route::delete('/comment/{comment}', [CommentController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dd', function () {

  return storage_path('images');
});
