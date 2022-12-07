<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

route::get('/getAllUsers', [UserController::class, 'getUsers']);
route::get('/getAllUsersToo', [UserController::class, 'getUsers'])->middleware('auth:sanctum');

route::get('/callApiWithToken', [ApiController::class, 'memanggilAPI']);

route::get('/getAllCollections', [ApiController::class, 'getCollections']);
route::get('/getAllLibraryUsers', [ApiController::class, 'getLibraryUsers']);
route::get('/getAllLibraryUsersPinjam', [ApiController::class, 'getLibraryUsersPinjam']);