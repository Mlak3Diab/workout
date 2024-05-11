<?php


use App\Http\Controllers\VerificationController;
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


Route::post('user/register',[AuthController::class, 'userRegister']);//postman
Route::post('user/password/email',  [AuthController::class,'userForgetPassword']);//postman
Route::post('user/password/code/check', [AuthController::class,'userCheckCode']);//postman
Route::post('user/password/reset', [AuthController::class ,'userResetPassword']);//postman
Route::post('user/CheckCodeemailverification', [AuthController::class,'userCheckCodeemailverification']);//postman

Route::group(['prefix' => 'user', 'middleware' => ['auth:user-api', 'scopes:user','myverified']], function () {
        Route::post('login',[AuthController::class, 'userLogin']);//postman
        Route::get('logout', [AuthController::class, 'userLogout']);  //postman
        Route::get('getBMI', [UserOperationController::class, 'GetBMI']);   //postman
        Route::post('add_user_profile_image', [UserOperationController::class, 'addProfilePicture']);   //postman
        Route::get('deleteprofile',[UserOperationController::class,'deleteprofile']); //postman
        Route::get('getinfo', [UserOperationController::class, 'getinfo']);   //postman
        Route::post('add_weight', [UserOperationController::class, 'addWeight']);   //postman
        Route::get('getweights', [UserOperationController::class, 'getallweights']);   //postman
        Route::post('editusername', [UserOperationController::class, 'editusername']);   //postman
        Route::delete('deleteprofileimage', [UserOperationController::class, 'deleteprofileimage']);   //postman
        Route::get('finishCourse/{course_id}',[UserOperationController::class, 'finishCourse']);
        Route::get('getallarticles',[UserOperationController::class, 'getallarticles']);
        Route::get('getinfoonearticle/{article_id}',[UserOperationController::class, 'getinfoonearticle']);
        Route::post('makeplan',[UserOperationController::class, 'makeplan']);   //postman
        Route::get('getplan',[UserOperationController::class, 'getplan']);
        Route::get('getAllCourses',[UserOperationController::class, 'getAllCourses']);   //postman
        Route::get('getAllExercisesForCourse/{course_id}',[UserOperationController::class, 'getAllExercisesForCourse']);   //postman
        Route::get('getAllChallenge', [UserOperationController::class, 'getAllChallenge']);   //postman
        Route::get('getChallengeExercises/{challenge_id}', [UserOperationController::class, 'getChallengeExercises']);
        Route::get('getExercisesForChallengeByWeek/{challenge_id}/{week}', [UserOperationController::class, 'getExercisesForChallengeByWeek']);   //postman
        Route::get('getexercisesfordayinweek/{week_id}',[UserOperationController::class,'getexercisesfordayinweek']);   //postman
        Route::get('getinfoforeachexerciseinplaninthisweek/{week_id}/{exercise_id}',[UserOperationController::class,'getinfoforeachexerciseinplaninthisweek']);   //postman
        Route::get('enrollUser/{challenge_id}',[UserOperationController::class,'enrollUser']);   //postman
        Route::get('getallproducts', [UserOperationController::class, 'getallproducts']);   //postman
        Route::get('buyaproduct/{product_id}', [UserOperationController::class, 'buyaproduct']);   //postman

    });
