<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\Exercise;
use App\Models\Muscle;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Weight;
use App\Models\Course;
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

       $bmi = ($lastWeight->weight_value / ($length * $length)) *10000;
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


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            // التحقق مما إذا كان هناك صورة قديمة، إذا كانت هناك، احذفها
            if ($user->image) {
                Storage::delete($user->image);
            }
                // تخزين الصورة الجديدة وتحديث المسار في قاعدة البيانات
                $path = $image->store('image');
                $user->image = $path;
                $user->save();
            return response()->json(['message' => 'Profile picture updated successfully'], 200);
        } else {
            return response()->json(['error' => 'No image uploaded'], 400);
        }
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

    //add total time and kcal when finish the course -
    public function finishCourse($course_id){
        $user_id = auth()->user()->id;
        $user = User::where('id',$user_id)->first();

        $course = Course::where('id',$course_id)->first();
        $kcal = $course->kcal;
        $time = $course->total_time;

        $user->total_time_practice = $time;
        $user->total_calorie = $kcal;
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
        $abs=$request->name1;
        $chest=$request->name2;
        $arm=$request->name3;
        $leg=$request->name4;
        $shoulderandback=$request->name5;
        $Fullbody=$request->name6;
        $array=[
            '1'=>$abs,
            '2'=>$chest,
            '3'=>$arm,
            '4'=>$leg,
            '5'=>$shoulderandback,
            '6'=>$Fullbody
        ];
        $loop=0;
        if($array[1]!=null)
            $loop+=1;
        if($array[2]!=null)
            $loop+=1;
        if($array[3]!=null)
            $loop+=1;
        if($array[4]!=null)
            $loop+=1;
        if($array[5]!=null)
            $loop+=1;
        if($array[6]!=null)
            $loop+=1;
        $plan=new Plan();
        $plan->user_id=$user_id;
        $plan->save();
        for($j = 1 ; $j<=4;$j++ ){
           for($i = 1; $i<=$loop;$i++ ){
                if( $request->name1=='abs'){
                    $course=Course::where('muscle',$request->name1)->where('level',"beginner")->first();
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

                else if($request->name2=='chest'){
                    $course=Course::where('muscle',$request->name2)->where('level',"beginner")->first();
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
           else  if($request->name3=='arm'){
               $course=Course::where('muscle',$request->name2)->where('level',"beginner")->first();
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
               else if($request->name4=='leg'){
                   $course=Course::where('muscle',$request->name2)->where('level',"beginner")->first();
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
               else if($request->name5=='shoulder and back'){
                   $course=Course::where('muscle',$request->name2)->where('level',"beginner")->first();
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
               else if( $request->name6=='Full body'){
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

    public function getAllCourses(){

        $courses = Course::all();
        return response()->json([
            'massege' => 'the all courses',
            'data' => $courses
        ]);

    }

    public function getAllExercisesForCourse($course_id){

        $course = Course::findOrFail($course_id);
        $exercises = $course->exercises()->get();
        return response()->json([
            'massege' => 'the all exercises for one course',
            'data' => $exercises,
        ]);

    }



}
