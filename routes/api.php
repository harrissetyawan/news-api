<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:api')->group(function () {

  Route::get('/news', [NewsController::class, 'index']);
  Route::get('/news/{id}', [NewsController::class, 'show']);
  Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);


Route::get('/dd', function () {
  $newsJointed = User::with('comments:id,comment', 'news:id,title,content')
    ->select('id', 'name', 'email', 'admin')
    ->get();

  return response()->json($newsJointed);
});
