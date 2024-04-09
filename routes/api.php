<?php

use App\Http\Controllers\userController;
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
Route::post('/register', [userController::class, 'register']);
Route::post('/login', [userController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function () {

});








Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
