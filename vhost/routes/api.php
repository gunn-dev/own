<?php

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/user/{id}', function ($id) {
//     return new UserResource(User::findOrFail($id));
// });

// Route::get('/users', function () {
//     return UserResource::collection(User::all());
// });

// Route::get('/users', function () {
//     return new UserCollection(User::all());
// });

// Route::apiResource('/users', UserController::class);
Route::apiResource('/article', ArticleController::class);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Route::apiResource([
//     'users' => UserController::class,
// ]);