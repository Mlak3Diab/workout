<?php


use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserOperationController;
use App\Http\Controllers\NotificationController;



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
Route::post('user/login',[AuthController::class, 'userLogin']);//postman
Route::post('user/password/email',  [AuthController::class,'userForgetPassword']);//postman
Route::post('user/password/code/check', [AuthController::class,'userCheckCode']);//postman
Route::post('user/password/reset', [AuthController::class ,'userResetPassword']);//postman
Route::post('user/CheckCodeemailverification', [AuthController::class,'userCheckCodeemailverification']);//postman

Route::group(['prefix' => 'user', 'middleware' => ['auth:user-api', 'scopes:user','myverified']], function () {

        Route::get('logout', [AuthController::class, 'userLogout']);  //postman
        Route::get('getBMI', [UserOperationController::class, 'GetBMI']);   //postman
        Route::post('add_user_profile_image', [UserOperationController::class, 'addProfilePicture']);   //postman
        Route::get('deleteprofile',[UserOperationController::class, 'deleteprofile']); //postman
        Route::get('getProfile', [UserOperationController::class, 'getinfo']);   //postman
        Route::post('add_weight', [UserOperationController::class, 'addWeight']);   //postman
        Route::get('getweights', [UserOperationController::class, 'getallweights']);   //postman
        Route::post('editusername', [UserOperationController::class, 'editusername']);   //postman
        Route::delete('deleteprofileimage', [UserOperationController::class, 'deleteprofileimage']);   //postman
        Route::get('finishCourse/{course_id}',[UserOperationController::class, 'finishCourse']);   //postman
        Route::get('getTotalTimeAndCalories', [UserOperationController::class, 'getTotalTimeAndCalories']);   //postman
        Route::get('getAllArticles',[UserOperationController::class, 'getallarticles']);   //postman
        Route::get('getInfoOneArticle/{article_id}',[UserOperationController::class, 'getinfoonearticle']);   //postman
        Route::post('makeplan',[UserOperationController::class, 'makeplan']);   //postman
        Route::get('getPlan/{week_id}',[UserOperationController::class, 'getPlan']);  //postman
        Route::get('getAllCourses',[UserOperationController::class, 'getAllCourses']);   //postman
        Route::get('getAllExercisesForCourse/{course_id}',[UserOperationController::class, 'getAllExercisesForCourse']);   //postman
        Route::get('getExerciseInfoForCourse/{course_id}/{exercise_id}', [UserOperationController::class, 'getExerciseInfoForCourse']);   //postman
        Route::get('getAllChallenge', [UserOperationController::class, 'getAllChallenge']);   //postman
    //new
        Route::get('getChallengeExercises/{challenge_id}/{week}', [UserOperationController::class, 'getChallengeExercises']);
        Route::get('getExercisesForChallengeByWeek/{challenge_id}/{week}', [UserOperationController::class, 'getExercisesForChallengeByWeek']);   //postman
        Route::get('getExerciseInfoForChallenge/{challenge_id}/{week}/{exercise_id}', [UserOperationController::class, 'getExerciseInfoForChallenge']);  //postman
        Route::get('getPlanExercisesForWeek/{week_id}',[UserOperationController::class,'getexercisesfordayinweek']);   //postman
        Route::get('getinfoforeachexerciseinplaninthisweek/{week_id}/{exercise_id}',[UserOperationController::class,'getinfoforeachexerciseinplaninthisweek']);   //postman
        Route::get('enrollUser/{challenge_id}',[UserOperationController::class, 'enrollUser']);   //postman
        Route::get('getClassification', [UserOperationController::class, 'getClassification']);
        Route::get('finishChallenge/{challenge_id}', [UserOperationController::class, 'finishChallenge']);
        Route::post('refreshtoken',[NotificationController::class, 'refreshtoken']);
    });






    //Route::post('sendChallengeNotification', [NotificationController::class, 'sendChallengeNotification']);
