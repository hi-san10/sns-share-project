<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NiceController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('posts', PostController::class);

Route::post('/register', [LoginController::class, 'register'])->middleware('firebase.auth');

Route::post('/login', [LoginController::class, 'login'])->middleware('firebase.auth');

Route::post('/comment', [CommentController::class, 'comment']);

Route::post('/nice', [NiceController::class, 'nice']);

Route::delete('posts/{id}/{user_id}', [PostController::class, 'destroy']);
