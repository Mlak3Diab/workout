<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserOperationController;



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
Route::post('user/password/email',  [AuthController::class,'userForgetPassword']);
Route::post('user/password/code/check', [AuthController::class,'userCheckCode']);
Route::post('user/password/reset', [AuthController::class ,'userResetPassword']);
Route::post('user/email/verification_notification',[AuthController::class, 'sendVerificationEmail']);
Route::get('user/verify-email/{id}/{hash}',[AuthController::class, 'verify'])->name('verification.verify');
Route::group(['prefix' => 'user','middleware' => [/*'verified',*/'auth:user-api','scopes:user'] ],function(){
    Route::get('logout',[AuthController::class, 'userLogout']);
    Route::get('getBMI',[UserOperationController::class, 'GetBMI']);
    Route::post('add_user_profile_image',[UserOperationController::class, 'addProfilePicture']);
    Route::get('getinfo',[UserOperationController::class, 'getinfo']);
});
