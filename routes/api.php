<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/home',             [PostController::class,'index']);
Route::post('/home',            [PostController::class,'store']);

Route::patch('/home/{id}',      [PostController::class,'update']);
Route::get('/home/{id}',        [PostController::class, 'show']);
Route::delete('/home/{id}',     [PostController::class,'delete']);

Route::post('/register',        [AuthController::class, 'register']);
Route::post('/login',           [AuthController::class, 'login']);
Route::get('/logout',           [AuthController::class, 'logout']);
Route::get('/me',               [AuthController::class, 'me']);

Route::post('/comment',         [CommentController::class, 'store']);
Route::delete('/comment/{id}',  [CommentController::class, 'delete']);

Route::post('/reply',           [ReplyController::class, 'store']);
Route::delete('/reply/{id}',    [ReplyController::class, 'delete']);

Route::post('/like',            [LikesController::class, 'store']);
