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

Route::post('trainer/register',[AuthController::class, 'trainerRegister']);
Route::post('trainer/login',[AuthController::class, 'trainerLogin']);
Route::group( ['prefix' => 'trainer','middleware' => ['auth:trainer-api','scopes:trainer'] ],function(){
    Route::post('logout',[AuthController::class, 'trainerLogout']);
});
Route::post('trainer/password/email',  [AuthController::class,'trainerForgetPassword']);
Route::post('trainer/password/code/check', [AuthController::class,'trainerCheckCode']);
Route::post('trainer/password/reset', [AuthController::class ,'trainerResetPassword']);
