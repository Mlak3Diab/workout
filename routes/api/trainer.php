<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrainerOperationController;
use App\Http\Controllers\VerifyEmailController;
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
Route::post('trainer/login',[AuthController::class, 'trainerLogin'])->middleware('verified');
Route::post('trainer/password/email',  [AuthController::class,'trainerForgetPassword']);
Route::post('trainer/password/code/check', [AuthController::class,'trainerCheckCode']);
Route::post('trainer/password/reset', [AuthController::class ,'trainerResetPassword']);
/*
// Verify email
Route::get('trainer/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invokeTrainer'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');
// Resend link to verify email
Route::post('trainer/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification link sent!']);
})->middleware(['auth:trainer-api', 'throttle:6,1'])->name('verification.send');
*/


Route::group( ['prefix' => 'trainer','middleware' => ['verified','auth:trainer-api','scopes:trainer'] ],function(){
    Route::post('logout',[AuthController::class, 'trainerLogout']);
    Route::post('add_user_profile_image',[TrainerOperationController::class, 'addProfilePicture']);

});

