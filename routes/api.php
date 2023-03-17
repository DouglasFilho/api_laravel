<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\DespesaController;
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

/*
|--------------------------------------------------------------------------
| Unauthenticated Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [LoginController::class, 'login']);

Route::apiResource('user', UserController::class)
  ->only(['store']);

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::apiResource('user', UserController::class)
  ->only(['index', 'show', 'update'])
  ->middleware('auth:sanctum');

Route::apiResource('despesa', DespesaController::class)
  ->only(['index', 'show', 'update', 'store', 'destroy'])
  ->middleware('auth:sanctum');