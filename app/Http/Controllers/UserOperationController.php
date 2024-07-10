<?php

namespace App\Http\Controllers;

use App\Mail\sendAgentslistandConfirmation;
use App\Mail\sendcodeverificationemail;
use App\Models\article;
use App\Models\Exercise;
use App\Models\Muscle;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Weight;
use App\Models\Course;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class UserOperationController extends Controller
{
    //Make BMI - GET
    public function GetBMI(){
        //find the user
        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id);
        //find the weight and length
        $lastWeight = Weight::where('user_id', $user->id)->latest()->first();
        $length = $user->length;

       $bmi = round(($lastWeight->weight_value / ($length * $length)) *10000,2);
       //  Update user's BMI
        $user->BMI = $bmi;
        $user->save();
        return response()->json([
            'BMI' => round($bmi, 2),
            'message' => 'BMI updated successfully',
        ]);
    }

    // Add Weight - POST
    public function addWeight(Request $request){
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);

        $request->validate([
            "weight" => 'required|numeric|min:1'
        ]);

        $weight = new Weight();
        $weight -> weight_value = $request -> weight;
        $weight -> user_id = $user_id;
        $weight->save();
        return response()->json([
            'message'=>'The Weight Added Succesfully'
            ]);
    }

    //get al weight for user _report - GET
    public function getallweights(Request $request){
        $user_id=auth()->user()->id;
        $array_weight=Weight::where('user_id',$user_id)->get();
        return response()->json([
            'weights' => $array_weight,
            'message' =>'your all weights ',
        ]);
    }

    //add picture -POST
    public function addProfilePicture(Request $request) {
        $user = auth()->user();
        $request->validate([
            'image' => 'image||mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $profile_image=time() . '.' .$image->getClientOriginalExtension();
            $image->move(public_path('user_profile_images'),$profile_image);
            $profile_image='user_profile_images/'.$profile_image;
            $user->image=$profile_image;
            $user->save();
            return response()->json(['message' => 'Profile picture updated successfully'], 200);
        } else {
            return response()->json(['error' => 'No image uploaded'], 400);
        }
    }

    public function deleteprofile(){
        $user = auth()->user();
        $user->image=null;
        $user->save();
        return response()->json(['message' => 'Profile picture deleted successfully'], 200);
    }

    //get info for user _GET
    public function getinfo(){
        $user_id=auth()->user()->id;
        $user=User::where('id',$user_id)->first();
        return response()->json([
            'status'=>true,
            'data'=>$user,
        ]);
    }

    public function getTotalTimeAndCalories(){
        $user=auth()->user();
        $total_time = $user->total_time_practice;
        $total_calories = $user->total_calorie;
        $points = $user->points;
        $classification = $user->classification;

        return response()->json([
            'total time' => $total_time,
            'total calories' => $total_calories,
            'points' => $points,
            'classificatoin' => $classification,
        ]);
    }

    //edit username _POST
    public function editusername(Request $request){
        $user=auth()->user();
        $request->validate([ 'username'=>'required',]);
        $user->username=$request->username;
        $user->save();
        return response()->json([
            'message' => 'your name edit successfully ',
            'user' => $user,
        ]);
    }

    // delete your profile -DELETE
    public function deleteprofileimage(){
        $user_id = auth()->user()->id;
        $user=User::where('id',$user_id)->first();
        // Delete profile picture if it exists
        if ($user->image) {
            Storage::delete($user->image);
            $user->image = null;
            $user->save();

            return response()->json(['message' => 'Profile picture deleted successfully']);
        } else {
            return response()->json(['message' => 'No profile picture to delete'], 404);
        }

    }

    //add total time and kcal when finish the course - GIT
    public function finishCourse($course_id){
        $user_id = auth()->user()->id;
        $user = User::where('id',$user_id)->first();

        $course = Course::where('id',$course_id)->first();
        $total_calories = $course->total_calories;
        $total_time = $course->total_time/60;

        $user->total_time_practice += $total_time;
        $user->total_calorie += $total_calories;
        $user->save();

        return response()->json([
            'message' => 'the time and calories added successfully'
        ]);
    }

    //get all articles GET
    public function getallarticles(){
        $articles=Article::all();
        return response()->json([
            'data'=>$articles,
        ]);
    }

    // get one info article
    public function getinfoonearticle($article_id){
        $article=Article::findOrFail($article_id)->first();
        return response()->json([
            'data'=>$article,
        ]);
    }

    protected function makeplan(Request $request){
        $user_id=auth()->user()->id;
        $array= $request->all();

        for($i = 1; $i<=sizeof($array);$i++ ){
            if($array[1])
                $array[1]="Full body";
            if ($array[2])
                $array[2]="chest";
            if ($array[3])
                $array[3]="shoulder and back";
            if ($array[4])
                $array[4]="arm";
            if ($array[5])
                $array[5]="abs";
            if ($array[6])
                $array[6]="leg";
        }
        $plan=new Plan();
        $plan->user_id=$user_id;
        $plan->save();
        for($j = 1 ; $j<=4;$j++ ){
           for($i = 1; $i<=sizeof($array);$i++ ){
                if( $array[$i]=='abs'){
                    $course=Course::where('muscle',$array[$i])->where('level',"beginner")->first();
                    $course_id=$course->id;
                    $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                    $plan=Plan::find($plan->id);
                    $exercise1=Exercise::where('id',$ec[0]->exercise_id)->first();
                    $exercise2=Exercise::where('id',$ec[1]->exercise_id)->first();
                    $exercise3=Exercise::where('id',$ec[2]->exercise_id)->first();
                    $exercise4=Exercise::where('id',$ec[3]->exercise_id)->first();

                    $plan->exercises()->attach($exercise1->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
                    $plan->exercises()->attach($exercise2->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
                    $plan->exercises()->attach($exercise3->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
                    $plan->exercises()->attach($exercise4->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);

              }

                 if($array[$i]=='chest'){
                    $course=Course::where('muscle',$array[$i])->where('level',"beginner")->first();
                    $course_id=$course->id;
                    $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                    $plan=Plan::find($plan->id);
                    $exercise5=Exercise::where('id',$ec[0]->exercise_id)->first();
                    $exercise6=Exercise::where('id',$ec[1]->exercise_id)->first();
                    $exercise7=Exercise::where('id',$ec[2]->exercise_id)->first();
                    $exercise8=Exercise::where('id',$ec[3]->exercise_id)->first();

                    $plan->exercises()->attach($exercise5->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
                    $plan->exercises()->attach($exercise6->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
                    $plan->exercises()->attach($exercise7->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
                    $plan->exercises()->attach($exercise8->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);


                }

             if($array[$i]=='arm'){
               $course=Course::where('muscle',$array[$i])->where('level',"beginner")->first();
               $course_id=$course->id;
               $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
               $plan=Plan::find($plan->id);
               $exercise9=Exercise::where('id',$ec[0]->exercise_id)->first();
               $exercise10=Exercise::where('id',$ec[1]->exercise_id)->first();
               $exercise11=Exercise::where('id',$ec[2]->exercise_id)->first();
               $exercise12=Exercise::where('id',$ec[3]->exercise_id)->first();

               $plan->exercises()->attach($exercise9->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
               $plan->exercises()->attach($exercise10->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
               $plan->exercises()->attach($exercise11->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
               $plan->exercises()->attach($exercise12->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);

           }//
                if($array[$i]=='leg'){
                   $course=Course::where('muscle',$array[$i])->where('level',"beginner")->first();
                   $course_id=$course->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                   $plan=Plan::find($plan->id);
                   $exercise13=Exercise::where('id',$ec[0]->exercise_id)->first();
                   $exercise14=Exercise::where('id',$ec[1]->exercise_id)->first();
                   $exercise15=Exercise::where('id',$ec[2]->exercise_id)->first();
                   $exercise16=Exercise::where('id',$ec[3]->exercise_id)->first();

                   $plan->exercises()->attach($exercise13->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
                   $plan->exercises()->attach($exercise14->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
                   $plan->exercises()->attach($exercise15->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
                   $plan->exercises()->attach($exercise16->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);

               }//
                if($array[$i]=='shoulder and back'){
                   $course=Course::where('muscle',$array[$i])->where('level',"beginner")->first();
                   $course_id=$course->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                   $plan=Plan::find($plan->id);
                   $exercise17=Exercise::where('id',$ec[0]->exercise_id)->first();
                   $exercise18=Exercise::where('id',$ec[1]->exercise_id)->first();
                   $exercise19=Exercise::where('id',$ec[2]->exercise_id)->first();
                   $exercise20=Exercise::where('id',$ec[3]->exercise_id)->first();

                   $plan->exercises()->attach($exercise17->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
                   $plan->exercises()->attach($exercise18->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
                   $plan->exercises()->attach($exercise19->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
                   $plan->exercises()->attach($exercise20->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);

               }
               //full body
                if( $array[$i]=='Full body'){
                   //abs
                   $course=Course::where('muscle','abs')->where('level',"beginner")->first();
                   $course_id=$course->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                   $plan=Plan::find($plan->id);
                   $exercise21=Exercise::where('id',$ec[0]->exercise_id)->first();
                   $exercise22=Exercise::where('id',$ec[1]->exercise_id)->first();
                   $exercise23=Exercise::where('id',$ec[2]->exercise_id)->first();
                   $exercise24=Exercise::where('id',$ec[3]->exercise_id)->first();

                   $plan->exercises()->attach($exercise21->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
                   $plan->exercises()->attach($exercise22->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
                   $plan->exercises()->attach($exercise23->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
                   $plan->exercises()->attach($exercise24->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);
                   //chest
                   $course=Course::where('muscle','chest')->where('level',"beginner")->first();
                   $course_id=$course->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                   $plan=Plan::find($plan->id);
                   $exercise25=Exercise::where('id',$ec[0]->exercise_id)->first();
                   $exercise26=Exercise::where('id',$ec[1]->exercise_id)->first();
                   $exercise27=Exercise::where('id',$ec[2]->exercise_id)->first();
                   $exercise28=Exercise::where('id',$ec[3]->exercise_id)->first();

                   $plan->exercises()->attach($exercise25->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
                   $plan->exercises()->attach($exercise26->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
                   $plan->exercises()->attach($exercise27->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
                   $plan->exercises()->attach($exercise28->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);
                   //arm
                   $course=Course::where('muscle','arm')->where('level',"beginner")->first();
                   $course_id=$course->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                   $plan=Plan::find($plan->id);
                   $exercise29=Exercise::where('id',$ec[0]->exercise_id)->first();
                   $exercise30=Exercise::where('id',$ec[1]->exercise_id)->first();
                   $exercise31=Exercise::where('id',$ec[2]->exercise_id)->first();
                   $exercise32=Exercise::where('id',$ec[3]->exercise_id)->first();

                   $plan->exercises()->attach($exercise29->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
                   $plan->exercises()->attach($exercise30->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
                   $plan->exercises()->attach($exercise31->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
                   $plan->exercises()->attach($exercise32->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);
                   //leg
                   $course=Course::where('muscle','leg')->where('level',"beginner")->first();
                   $course_id=$course->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                   $plan=Plan::find($plan->id);
                   $exercise33=Exercise::where('id',$ec[0]->exercise_id)->first();
                   $exercise34=Exercise::where('id',$ec[1]->exercise_id)->first();
                   $exercise35=Exercise::where('id',$ec[2]->exercise_id)->first();
                   $exercise36=Exercise::where('id',$ec[3]->exercise_id)->first();

                   $plan->exercises()->attach($exercise33->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
                   $plan->exercises()->attach($exercise34->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
                   $plan->exercises()->attach($exercise35->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
                   $plan->exercises()->attach($exercise36->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);
                   //shoulder and back
                   $course=Course::where('muscle','shoulder and back')->where('level',"beginner")->first();
                   $course_id=$course->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                   $plan=Plan::find($plan->id);
                   $exercise37=Exercise::where('id',$ec[0]->exercise_id)->first();
                   $exercise38=Exercise::where('id',$ec[1]->exercise_id)->first();
                   $exercise39=Exercise::where('id',$ec[2]->exercise_id)->first();
                   $exercise40=Exercise::where('id',$ec[3]->exercise_id)->first();

                   $plan->exercises()->attach($exercise37->id,['number_of_week'=>$j,'repetition'=>$ec[0]->repetition,'time'=>$ec[0]->time,]);
                   $plan->exercises()->attach($exercise38->id,['number_of_week'=>$j,'repetition'=>$ec[1]->repetition,'time'=>$ec[1]->time,]);
                   $plan->exercises()->attach($exercise39->id,['number_of_week'=>$j,'repetition'=>$ec[2]->repetition,'time'=>$ec[2]->time,]);
                   $plan->exercises()->attach($exercise40->id,['number_of_week'=>$j,'repetition'=>$ec[3]->repetition,'time'=>$ec[3]->time,]);
               }

        }
        }

        return response()->json([
            'message'=> ' your plan stored successfully',

        ]);
    }

<<<<<<< HEAD
    public function getPlan($week_id){
        $data=[];
        $user_id = auth()->user()->id;
        $plan = Plan::where('user_id',$user_id)->first();
        $exercise_for_day_in_week=$plan->exercises()->wherePivot('number_of_week',$week_id)->get();
        for($i=0 ;$i<sizeof($exercise_for_day_in_week);$i++){
            $time=$plan->exercises()->wherePivot('number_of_week',$week_id)->wherePivot('exercise_id',$exercise_for_day_in_week[$i]->id)->select('time')->first();
            $repetition=$plan->exercises()->wherePivot('number_of_week',$week_id)->wherePivot('exercise_id',$exercise_for_day_in_week[$i]->id)->select('repetition')->first();
            $data[$i]=['exercise'=> $exercise_for_day_in_week[$i], 'time'=>$time , 'repetition'=> $repetition];
        }
     return response()->json([
                'data' =>$data,
        ]);
=======

    public function getPlan()
    {
        $user_id = auth()->user()->id;
        $user_plan = Plan::with('exercises')->where('user_id', $user_id)->firstOrFail();

        $exercises = $user_plan->exercises->map(function ($exercise) {
            return [
                'id' => $exercise->id,
                'name' => $exercise->localized_name,
                'description' => $exercise->localized_description,
                'gif' => $exercise->gif,
                'calories' => $exercise->calories,

            ];
        });

        return response()->json([
            'plan' => [
                'id' => $user_plan->id,
                'user_id' => $user_plan->user_id,
                'exercises' => $exercises,
            ]
        ], 200);
>>>>>>> be6f75b5b254dba4046e2118677ffd4adf6e02ae
    }


    public function getAllCourses()
    {
        $courses = Course::all()->map(function ($course) {
            return [
                'id' => $course->id,
                'name' => $course->localized_name,
                'total_calories' => $course->total_calories,
                'total_time' => $course->total_time,
                'muscle' => $course->localized_muscle,
                'level' => $course->localized_level,
            ];
        });

        return response()->json([
            'message' => 'the all courses',
            'data' => $courses
        ]);
    }



    public function getAllExercisesForCourse($course_id)
    {
        $course = Course::findOrFail($course_id);
        $exercises = $course->exercises()->get();

        $localizedExercises = $exercises->map(function ($exercise) {
            return [
                'id' => $exercise->id,
                'name' => $exercise->localized_name,
                'description' => $exercise->localized_description,
                'gif' => $exercise->gif,
                'calories' => $exercise->calories,
            ];
        });

        return response()->json([
            'message' => 'The all exercises for one course',
            'data' => $localizedExercises,
        ]);
    }



    public function getExerciseInfoForCourse($course_id, $exercise_id)
    {
        $user_id=auth()->user()->id;
        $course=Course::where('id',$course_id)->first();

        $exercise=$course->exercises()->wherePivot('exercise_id',$exercise_id)->first();
        $time=$course->exercises()->wherePivot('exercise_id',$exercise_id)->select('time')->first();
        $repetition=$course->exercises()->wherePivot('exercise_id',$exercise_id)->select('repetition')->first();

        if($exercise == null){
            return response()->json([
                'message' => 'Exercise Not Found',
            ], 404);
        }

        return response()->json([
            'message' => 'The Exercise Detail.',
            'exercise' => [
                'id' => $exercise->id,
                'name' => $exercise->localized_name,
                'description' => $exercise->localized_description,
                'gif' => $exercise->gif,
                'calories' => $exercise->calories,
                'time' => $time->time,
                'repetition' => $repetition->repetition,
            ],
        ]);
    }

    public function getAllChallenge(){

        $challenges = Challenge::all();
        return response()->json([
            'data' => $challenges,
        ]);
    }
<<<<<<< HEAD
/////////new
    public function getChallengeExercises($challenge_id,$week){
        $data=[];
        $challenge=Challenge::where('id',$challenge_id)->first();
        $exercises=$challenge->exercises()->wherePivot('week',$week)->get();
        for($i=0 ;$i<sizeof($exercises);$i++) {
            $time = $challenge->exercises()->wherePivot('week', $week)->wherePivot('exercise_id', $exercises[$i]->id)->select('time')->first();
            $repetition = $challenge->exercises()->wherePivot('week', $week)->wherePivot('exercise_id', $exercises[$i]->id)->select('repetition')->first();
            $data[$i]=['exercise'=> $exercises[$i], 'time'=>$time , 'repetition'=> $repetition];
        }
        return response()->json([
            'data' => $data,
            ]);
=======

    public function getChallengeExercises($challenge_id){

        $challenge = Challenge::with('exercises')->findOrFail($challenge_id);

        $exercises = $challenge->exercises()->get();

        $localizedExercises = $exercises->map(function ($exercise) {
            return [
                'id' => $exercise->id,
                'name' => $exercise->localized_name,
                'description' => $exercise->localized_description,
                'gif' => $exercise->gif,
                'calories' => $exercise->calories,
            ];
        });

        return response()->json([
            'message' => 'The all exercises for the challenge',
            'data' => $localizedExercises,
        ]);

>>>>>>> be6f75b5b254dba4046e2118677ffd4adf6e02ae
    }

    public function getExercisesForChallengeByWeek($challengeId, $week)
    {
        // Validate week input
        if (!in_array($week, [1, 2, 3, 4])) {
            return response()->json(['error' => 'Invalid week. Week must be 1, 2, 3, or 4.'], 400);
        }

        $challenge = Challenge::findOrFail($challengeId);

        $exercises = $challenge->exercises()->wherePivot('week', $week)->get();

        return response()->json([
            'message' => 'The Exercise Detail.',
            'exercise' => [
                'id' => $exercise->id,
                'name' => $exercise->localized_name,
                'description' => $exercise->localized_description,
                'gif' => $exercise->gif,
                'calories' => $exercise->calories,
                'time' => $time->time,
                'repetition' => $repetition->repetition,
            ],
        ]);

    }

    public function getExerciseInfoForChallenge($challenge_id,$week_id,$exercise_id){
        $user_id=auth()->user()->id;
        $challenge=Challenge::where('id',$challenge_id)->first();

        $exercise=$challenge->exercises()->wherePivot('week',$week_id)->wherePivot('exercise_id',$exercise_id)->first();
        $time=$challenge->exercises()->wherePivot('week',$week_id)->wherePivot('exercise_id',$exercise_id)->select('time')->first();
        $repetition=$challenge->exercises()->wherePivot('week',$week_id)->wherePivot('exercise_id',$exercise_id)->select('repetition')->first();

        if($exercise == null){
            return response()->json([
                'message' => 'Exercise Not Found'
            ], 404);
        }

        return response()->json([
            'message' => 'The Exercise Detail.',
            'exercise' => [
                'id' => $exercise->id,
                'name' => $exercise->localized_name,
                'description' => $exercise->localized_description,
                'gif' => $exercise->gif,
                'calories' => $exercise->calories,
                'time' => $time->time,
                'repetition' => $repetition->repetition,
            ],
        ]);
    }

    // get exercise for everyday in plan in the first week
    public function getexercisesfordayinweek($week_id){
        $user_id=auth()->user()->id;
        $plan=Plan::where('user_id',$user_id)->first();
        $exercises_for_day_in_week=$plan->exercises()->wherePivot('number_of_week',$week_id)->get();
        return response()->json([
           'message'=>'your exercises for every day in first week',
           'exercises_for_day_in_week'=> $exercises_for_day_in_week,
        ]);
    }

    //get info for each exercise in plan in this week
    public function getinfoforeachexerciseinplaninthisweek($week_id,$exercise_id){

        $user_id=auth()->user()->id;

        $plan=Plan::where('user_id',$user_id)->first();
        $exercise_for_day_in_week=$plan->exercises()->wherePivot('number_of_week',$week_id)->wherePivot('exercise_id',$exercise_id)->first();
        $time=$plan->exercises()->wherePivot('number_of_week',$week_id)->wherePivot('exercise_id',$exercise_id)->select('time')->first();
        $repetition=$plan->exercises()->wherePivot('number_of_week',$week_id)->wherePivot('exercise_id',$exercise_id)->select('repetition')->first();
        return response()->json([
            'message'=>'your exercises for every day in first week',
            'exercise_for_day_in_week'=> $exercise_for_day_in_week,
            'time'=>$time,
            'repetition'=>$repetition,

        ]);
    }


    public function enrollUser($challenge_id)
    {
        $user = auth()->user();

        // Check if the challenge exists
        $challenge = Challenge::find($challenge_id);

        if (!$challenge) {
            return response()->json([
                'message' => 'Challenge not found'
            ], 404);
        }

        // Check if the user is already enrolled in the challenge
        if ($user->challenges()->where('challenge_id', $challenge->id)->exists()) {
            return response()->json([
                'message' => 'User is already enrolled in this challenge'
            ], 400);
        }

        // Enroll the user in the challenge
        $user->challenges()->attach($challenge);

        return response()->json([
            'message' => 'User enrolled in the challenge successfully.'
        ], 200);

    }


    public function finishChallenge($challenge_id){
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated'
            ], 401);
        }

        $challenge = Challenge::find($challenge_id);

        if (!$challenge) {
            return response()->json([
                'message' => 'Challenge not found'
            ], 404);
        }

        $total_calories = $challenge->total_calories;
        $total_time = $challenge->total_time / 60;
        $points = $challenge->points;

        $user->total_time_practice = $total_time;
        $user->total_calorie = $total_calories;
        $user->points = $points;
        $user->save();

        return response()->json([
            'message' => 'The data of user updated successfully',
            'data' => [
                'total_calories' => $total_calories,
                'total_time' => round($total_time,0),
                'points' => $points
            ]
        ]);
    }

    public function getClassification(){
        $user_id = auth()->user()->id;
        $user = User::where('id',$user_id)->first();
        $points = $user->points;
        if($points <0)
            return response()->json([
                'message' => 'The Points is Negetive',
            ],400);
        $classification ="";
        if($points < 100 && $points >-1)
            $classification = "Bronze";
        if($points < 200 && $points >= 100)
            $classification = "Silver";
        if($points > 200)
            $classification = "Golden";

        $user->classification = $classification;
        $user->save();

        return response()->json([
            'message' => 'the classification apdated successfully.',
            'data' => $classification,
        ]);
    }



}
