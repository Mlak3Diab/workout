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

Route::post('trainer/register',[AuthController::class, 'trainerRegister']);//postman
//Route::post('trainer/login',[AuthController::class, 'trainerLogin'])->middleware('myverified');//postman
Route::post('trainer/password/email',  [AuthController::class,'trainerForgetPassword']);//postman
Route::post('trainer/password/code/check', [AuthController::class,'trainerCheckCode']);//postman
Route::post('trainer/password/reset', [AuthController::class ,'trainerResetPassword']);//postman
Route::post('trainer/CheckCodeemailverification', [AuthController::class,'trainerCheckCodeemailverification']);//postman
Route::group( ['prefix' => 'trainer','middleware' => ['auth:trainer-api','scopes:trainer','myverified'] ],function(){

    Route::post('login',[AuthController::class, 'trainerLogin']);//postman
    Route::post('logout',[AuthController::class, 'trainerLogout']);//postman
    Route::post('add_user_profile_image',[TrainerOperationController::class, 'addProfilePicture']);   //postman
    Route::get('getinfo',[TrainerOperationController::class, 'getinfo']);   //postman
    Route::post('addarticle',[TrainerOperationController::class, 'addarticle']);   //postman
    Route::get('getarticle',[TrainerOperationController::class, 'getarticle']);   //postman
    Route::delete('deletearticle/{article_id}',[TrainerOperationController::class, 'deletearticle']);   //postman
    Route::post('editusername', [TrainerOperationController::class, 'editusername']);
    Route::get('getallexercises', [TrainerOperationController::class, 'getallexercises']);
    Route::post('addChallenge', [TrainerOperationController::class, 'addChallenge']);  //postman
    Route::get('getTranierChallenge', [TrainerOperationController::class, 'getTranierChallenge']);   //postman
    Route::get('getChallengeData/{challenge_id}', [TrainerOperationController::class, 'getChallengeData']);   //postman
    Route::delete('deleteChallenge/{challenge_id}', [TrainerOperationController::class, 'deleteChallenge']);   //postman
    Route::get('getUserEnrolledChallengesByTrainer',[TrainerOperationController::class, 'getUserEnrolledChallengesByTrainer']);   //postman
    Route::post('addproduct', [TrainerOperationController::class, 'addproduct']);  //postman
    Route::get('deleteprofile',[TrainerOperationController::class,'deleteprofile']); //postman
    Route::get('deleteproduct/{product_id}',[TrainerOperationController::class,'deleteproduct']);//postman
    Route::get('getproductstrainer',[TrainerOperationController::class,'getproductstrainer']); //postman



});
