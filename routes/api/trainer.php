<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrainerOperationController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\VerificationControllerTrainer;
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
Route::post('trainer/login',[AuthController::class, 'trainerLogin']);
Route::post('trainer/password/email',  [AuthController::class,'trainerForgetPassword']);
Route::post('trainer/password/code/check', [AuthController::class,'trainerCheckCode']);
Route::post('trainer/password/reset', [AuthController::class ,'trainerResetPassword']);

Route::get('/email/resend', [VerificationControllerTrainer::class, 'resend'])->name('verification.resend');
Route::get('/email/verify/{id}/{hash}', [VerificationControllerTrainer::class, 'verify'])->name('verification.verify');

Route::group( ['prefix' => 'trainer','middleware' => [/*'verified',*/'auth:trainer-api','scopes:trainer'] ],function(){
    Route::post('logout',[AuthController::class, 'trainerLogout']);
    Route::post('add_user_profile_image',[TrainerOperationController::class, 'addProfilePicture']);
    Route::get('getinfo',[TrainerOperationController::class, 'getinfo']);
    Route::post('addarticle',[TrainerOperationController::class, 'addarticle']);
    Route::get('getarticle',[TrainerOperationController::class, 'getarticle']);
    Route::delete('deletearticle/{article_id}',[TrainerOperationController::class, 'deletearticle']);
    Route::post('editusername', [TrainerOperationController::class, 'editusername']);
    Route::get('getallexercises', [TrainerOperationController::class, 'getallexercises']);


});

