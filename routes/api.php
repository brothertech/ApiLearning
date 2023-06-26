<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserComptroller;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', ApiController::class);



Route::get('users/{id}', [ApiController::class, 'show']);
// Route::delete('users/{id}', [ApiController::class, 'destroy']);

// Route::get('users', [ApiController::class, 'index']);
//trying to follow the stack developer

Route::get('stack/{id?}', [UserComptroller::class, 'getUsers']);//the ? make it an optional condition
Route::post('stack', [UserComptroller::class, 'add_single_user']);
Route::post('stack', [UserComptroller::class, 'add_multiples_users']);
Route::put('stack/{id}', [UserComptroller::class, 'update']);
Route::patch('stack/{id}', [UserComptroller::class, 'patch_name']);
Route::delete('stack/{id}', [UserComptroller::class, 'delete_single_user']);
Route::delete('stacks/{ids}', [UserComptroller::class, 'delete_multiple_users']);