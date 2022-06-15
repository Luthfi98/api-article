<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PostsController;
// use App\Http\Controllers\TransactionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/article', [PostsController::class, 'insert']);
Route::post('/article/{id}', [PostsController::class, 'update']);
Route::get('/article', [PostsController::class, 'get']);
Route::get('/article/{id}', [PostsController::class, 'get']);
Route::delete('/article/{id}', [PostsController::class, 'delete']);