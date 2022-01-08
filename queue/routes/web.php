<?php

use App\Http\Controllers\UserController;
use App\Jobs\JobCall;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     dispatch(new JobCall);
//     JobCall::dispatch()->onQueue('high'); //JobCall Dispatch not need to use
//     return "Success";
// });

Route::get('/', [UserController::class, 'create']);
Route::post('/store', [UserController::class, 'store'])->name('store');
