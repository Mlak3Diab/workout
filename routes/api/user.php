<?php


use App\Http\Controllers\AuthController;
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



Route::post('user/register',[AuthController::class, 'userRegister']);
Route::post('user/login',[AuthController::class, 'userLogin']);
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
    Route::post('logout',[AuthController::class, 'userLogout']);
});
Route::post('user/password/email',  [AuthController::class,'userForgetPassword']);
Route::post('user/password/code/check', [AuthController::class,'userCheckCode']);
Route::post('user/password/reset', [AuthController::class ,'userResetPassword']);
