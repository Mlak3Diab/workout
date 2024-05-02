<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\Exercise;
use App\Models\Muscle;
use App\Models\Plan;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Weight;
use App\Models\Course;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

        for($j = 1 ; $j<=4;$j++ ){
           for($i = 1; $i<=$loop;$i++ ){
                if( $request->name1=='abs'){
                    $course=Course::where('muscle',$request->name1)->where('level',"beginner")->first();
                    $course_id=$course->id;
                    $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();

                        $plan1 = new Plan();
                        $plan1->exercise_id=$ec[0]->exercise_id;
                        $plan1->time=$ec[0]->time;
                        $plan1->repetition=$ec[0]->repetition;


                        $plan2 = new Plan();
                        $plan2->exercise_id=$ec[1]->exercise_id;
                        $plan2->time=$ec[1]->time;
                        $plan2->repetition=$ec[1]->repetition;

                        $plan3 = new Plan();
                        $plan3->exercise_id=$ec[2]->exercise_id;
                        $plan3->time=$ec[2]->time;
                        $plan3->repetition=$ec[2]->repetition;

                        $plan4 = new Plan();
                        $plan4->exercise_id=$ec[3]->exercise_id;
                        $plan4->time=$ec[3]->time;
                        $plan4->repetition=$ec[3]->repetition;

                        $plan1->user_id=$user_id;
                        $plan1->plan=$user_id;
                        $plan1->number_of_week=$j;
                        $plan2->user_id=$user_id;
                        $plan2->plan=$user_id;
                        $plan2->number_of_week=$j;
                        $plan3->user_id=$user_id;
                        $plan3->plan=$user_id;
                        $plan3->number_of_week=$j;
                        $plan4->user_id=$user_id;
                        $plan4->plan=$user_id;
                        $plan4->number_of_week=$j;

                        $plan1->save();
                        $plan2->save();
                        $plan3->save();
                        $plan4->save();

                }

                else if($request->name2=='chest'){
                    $course=Course::where('muscle',$request->name2)->where('level',"beginner")->first();
                    $course_id=$course->id;
                    $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                        $plan5 = new Plan();
                        $plan5->exercise_id=$ec[0]->exercise_id;
                        $plan5->time=$ec[0]->time;
                        $plan5->repetition=$ec[0]->repetition;


                        $plan6 = new Plan();
                        $plan6->exercise_id=$ec[1]->exercise_id;
                        $plan6->time=$ec[1]->time;
                        $plan6->repetition=$ec[1]->repetition;

                        $plan7 = new Plan();
                        $plan7->exercise_id=$ec[2]->exercise_id;
                        $plan7->time=$ec[2]->time;
                        $plan7->repetition=$ec[2]->repetition;

                        $plan8 = new Plan();
                        $plan8->exercise_id=$ec[3]->exercise_id;
                        $plan8->time=$ec[3]->time;
                        $plan8->repetition=$ec[3]->repetition;

                        $plan5->user_id=$user_id;
                        $plan5->plan=$user_id;
                        $plan5->number_of_week=$j;
                        $plan6->user_id=$user_id;
                        $plan6->plan=$user_id;
                        $plan6->number_of_week=$j;
                        $plan7->user_id=$user_id;
                        $plan7->plan=$user_id;
                        $plan7->number_of_week=$j;
                        $plan8->user_id=$user_id;
                        $plan8->plan=$user_id;
                        $plan8->number_of_week=$j;

                        $plan5->save();
                        $plan6->save();
                        $plan7->save();
                        $plan8->save();

               }
           else  if($request->name3=='arm'){
                    $course=Course::where('muscle',$request->name3)->where('level',"beginner")->first();
                    $course_id=$course->id;
                    $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                        $plan9 = new Plan();
                        $plan9->exercise_id=$ec[0]->exercise_id;
                        $plan9->time=$ec[0]->time;
                        $plan9->repetition=$ec[0]->repetition;


                        $plan10 = new Plan();
                        $plan10->exercise_id=$ec[1]->exercise_id;
                        $plan10->time=$ec[1]->time;
                        $plan10->repetition=$ec[1]->repetition;

                        $plan11 = new Plan();
                        $plan11->exercise_id=$ec[2]->exercise_id;
                        $plan11->time=$ec[2]->time;
                        $plan11->repetition=$ec[2]->repetition;

                        $plan12 = new Plan();
                        $plan12->exercise_id=$ec[3]->exercise_id;
                        $plan12->time=$ec[3]->time;
                        $plan12->repetition=$ec[3]->repetition;

                        $plan9->user_id=$user_id;
                        $plan9->plan=$user_id;
                        $plan9->number_of_week=$j;
                        $plan10->user_id=$user_id;
                        $plan10->plan=$user_id;
                        $plan10->number_of_week=$j;
                        $plan1->user_id=$user_id;
                        $plan11->plan=$user_id;
                        $plan11->number_of_week=$j;
                        $plan12->user_id=$user_id;
                        $plan12->plan=$user_id;
                        $plan12->number_of_week=$j;

                        $plan9->save();
                        $plan10->save();
                        $plan11->save();
                        $plan12->save();
                }//
               else if($request->name4=='leg'){
                    $course=Course::where('muscle',$request->name4)->where('level',"beginner")->first();
                    $course_id=$course->id;
                    $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                        $plan13 = new Plan();
                        $plan13->exercise_id=$ec[0]->exercise_id;
                        $plan13->time=$ec[0]->time;
                        $plan13->repetition=$ec[0]->repetition;


                        $plan14 = new Plan();
                        $plan14->exercise_id=$ec[1]->exercise_id;
                        $plan14->time=$ec[1]->time;
                        $plan14->repetition=$ec[1]->repetition;

                        $plan15 = new Plan();
                        $plan15->exercise_id=$ec[2]->exercise_id;
                        $plan15->time=$ec[2]->time;
                        $plan15->repetition=$ec[2]->repetition;

                        $plan16= new Plan();
                        $plan16->exercise_id=$ec[3]->exercise_id;
                        $plan16->time=$ec[3]->time;
                        $plan16->repetition=$ec[3]->repetition;

                        $plan13->user_id=$user_id;
                        $plan13->plan=$user_id;
                        $plan13->number_of_week=$j;
                        $plan14->user_id=$user_id;
                        $plan14->plan=$user_id;
                        $plan14->number_of_week=$j;
                        $plan15->user_id=$user_id;
                        $plan15->plan=$user_id;
                        $plan15->number_of_week=$j;
                        $plan16->user_id=$user_id;
                        $plan16->plan=$user_id;
                        $plan16->number_of_week=$j;

                        $plan13->save();
                        $plan14->save();
                        $plan15->save();
                        $plan16->save();
                }//
               else if($request->name5=='shoulder and back'){
                    $course=Course::where('muscle',$request->name5)->where('level',"beginner")->first();
                    $course_id=$course->id;
                    $ec=DB::table('course_exercise')->where('course_id',$course_id)->inRandomOrder()->limit(4)->get();
                        $plan17 = new Plan();
                        $plan17->exercise_id=$ec[0]->exercise_id;
                        $plan17->time=$ec[0]->time;
                        $plan17->repetition=$ec[0]->repetition;

                        $plan18 = new Plan();
                        $plan18->exercise_id=$ec[1]->exercise_id;
                        $plan18->time=$ec[1]->time;
                        $plan18->repetition=$ec[1]->repetition;

                        $plan19 = new Plan();
                        $plan19->exercise_id=$ec[2]->exercise_id;
                        $plan19->time=$ec[2]->time;
                        $plan19->repetition=$ec[2]->repetition;

                        $plan20 = new Plan();
                        $plan20->exercise_id=$ec[3]->exercise_id;
                        $plan20->time=$ec[3]->time;
                        $plan20->repetition=$ec[3]->repetition;

                        $plan17->user_id=$user_id;
                        $plan17->plan=$user_id;
                        $plan17->number_of_week=$j;
                        $plan18->user_id=$user_id;
                        $plan18->plan=$user_id;
                        $plan18->number_of_week=$j;
                        $plan19->user_id=$user_id;
                        $plan19->plan=$user_id;
                        $plan19->number_of_week=$j;
                        $plan20->user_id=$user_id;
                        $plan20->plan=$user_id;
                        $plan20->number_of_week=$j;

                        $plan17->save();
                        $plan18->save();
                        $plan19->save();
                        $plan20->save();
                }//
               else if( $request->name6=='Full body'){

                   $course1=Course::where('muscle','abs')->where('level',"beginner")->first();
                   $course_id1=$course1->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id1)->inRandomOrder()->limit(4)->get();

                   $plan21 = new Plan();
                   $plan21->exercise_id=$ec[0]->exercise_id;
                   $plan21->time=$ec[0]->time;
                   $plan21->repetition=$ec[0]->repetition;


                   $plan22 = new Plan();
                   $plan22->exercise_id=$ec[1]->exercise_id;
                   $plan22->time=$ec[1]->time;
                   $plan22->repetition=$ec[1]->repetition;

                   $plan23 = new Plan();
                   $plan23->exercise_id=$ec[2]->exercise_id;
                   $plan23->time=$ec[2]->time;
                   $plan23->repetition=$ec[2]->repetition;

                   $plan24 = new Plan();
                   $plan24->exercise_id=$ec[3]->exercise_id;
                   $plan24->time=$ec[3]->time;
                   $plan24->repetition=$ec[3]->repetition;

                   $plan21->user_id=$user_id;
                   $plan21->plan=$user_id;
                   $plan21->number_of_week=$j;
                   $plan22->user_id=$user_id;
                   $plan22->plan=$user_id;
                   $plan22->number_of_week=$j;
                   $plan23->user_id=$user_id;
                   $plan23->plan=$user_id;
                   $plan23->number_of_week=$j;
                   $plan24->user_id=$user_id;
                   $plan24->plan=$user_id;
                   $plan24->number_of_week=$j;

                   $plan21->save();
                   $plan22->save();
                   $plan23->save();
                   $plan24->save();

                   $course2=Course::where('muscle','arm')->where('level',"beginner")->first();
                   $course_id2=$course2->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id2)->inRandomOrder()->limit(4)->get();

                   $plan25 = new Plan();
                   $plan25->exercise_id=$ec[0]->exercise_id;
                   $plan25->time=$ec[0]->time;
                   $plan25->repetition=$ec[0]->repetition;


                   $plan26 = new Plan();
                   $plan26->exercise_id=$ec[1]->exercise_id;
                   $plan26->time=$ec[1]->time;
                   $plan26->repetition=$ec[1]->repetition;

                   $plan27 = new Plan();
                   $plan27->exercise_id=$ec[2]->exercise_id;
                   $plan27->time=$ec[2]->time;
                   $plan27->repetition=$ec[2]->repetition;

                   $plan28 = new Plan();
                   $plan28->exercise_id=$ec[3]->exercise_id;
                   $plan28->time=$ec[3]->time;
                   $plan28->repetition=$ec[3]->repetition;

                   $plan25->user_id=$user_id;
                   $plan25->plan=$user_id;
                   $plan25->number_of_week=$j;
                   $plan26->user_id=$user_id;
                   $plan26->plan=$user_id;
                   $plan26->number_of_week=$j;
                   $plan27->user_id=$user_id;
                   $plan27->plan=$user_id;
                   $plan27->number_of_week=$j;
                   $plan28->user_id=$user_id;
                   $plan28->plan=$user_id;
                   $plan28->number_of_week=$j;

                   $plan25->save();
                   $plan26->save();
                   $plan27->save();
                   $plan28->save();

                   $course3=Course::where('muscle','leg')->where('level',"beginner")->first();
                   $course_id3=$course3->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id3)->inRandomOrder()->limit(4)->get();

                   $plan29 = new Plan();
                   $plan29->exercise_id=$ec[0]->exercise_id;
                   $plan29->time=$ec[0]->time;
                   $plan29->repetition=$ec[0]->repetition;


                   $plan30 = new Plan();
                   $plan30->exercise_id=$ec[1]->exercise_id;
                   $plan30->time=$ec[1]->time;
                   $plan30->repetition=$ec[1]->repetition;

                   $plan31 = new Plan();
                   $plan31->exercise_id=$ec[2]->exercise_id;
                   $plan31->time=$ec[2]->time;
                   $plan31->repetition=$ec[2]->repetition;

                   $plan32 = new Plan();
                   $plan32->exercise_id=$ec[3]->exercise_id;
                   $plan32->time=$ec[3]->time;
                   $plan32->repetition=$ec[3]->repetition;

                   $plan29->user_id=$user_id;
                   $plan29->plan=$user_id;
                   $plan29->number_of_week=$j;
                   $plan30->user_id=$user_id;
                   $plan30->plan=$user_id;
                   $plan30->number_of_week=$j;
                   $plan31->user_id=$user_id;
                   $plan31->plan=$user_id;
                   $plan31->number_of_week=$j;
                   $plan32->user_id=$user_id;
                   $plan32->plan=$user_id;
                   $plan32->number_of_week=$j;

                   $plan29->save();
                   $plan30->save();
                   $plan31->save();
                   $plan32->save();

                   $course4=Course::where('muscle','chest')->where('level',"beginner")->first();
                   $course_id4=$course4->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id4)->inRandomOrder()->limit(4)->get();

                   $plan33 = new Plan();
                   $plan33->exercise_id=$ec[0]->exercise_id;
                   $plan33->time=$ec[0]->time;
                   $plan33->repetition=$ec[0]->repetition;


                   $plan34 = new Plan();
                   $plan34->exercise_id=$ec[1]->exercise_id;
                   $plan34->time=$ec[1]->time;
                   $plan34->repetition=$ec[1]->repetition;

                   $plan35 = new Plan();
                   $plan35->exercise_id=$ec[2]->exercise_id;
                   $plan35->time=$ec[2]->time;
                   $plan35->repetition=$ec[2]->repetition;

                   $plan36 = new Plan();
                   $plan36->exercise_id=$ec[3]->exercise_id;
                   $plan36->time=$ec[3]->time;
                   $plan36->repetition=$ec[3]->repetition;

                   $plan33->user_id=$user_id;
                   $plan33->plan=$user_id;
                   $plan33->number_of_week=$j;
                   $plan34->user_id=$user_id;
                   $plan34->plan=$user_id;
                   $plan34->number_of_week=$j;
                   $plan35->user_id=$user_id;
                   $plan35->plan=$user_id;
                   $plan35->number_of_week=$j;
                   $plan36->user_id=$user_id;
                   $plan36->plan=$user_id;
                   $plan36->number_of_week=$j;

                   $plan33->save();
                   $plan34->save();
                   $plan35->save();
                   $plan36->save();

                   $course5=Course::where('muscle','shoulder and back')->where('level',"beginner")->first();
                   $course_id5=$course5->id;
                   $ec=DB::table('course_exercise')->where('course_id',$course_id5)->inRandomOrder()->limit(4)->get();

                   $plan37 = new Plan();
                   $plan37->exercise_id=$ec[0]->exercise_id;
                   $plan37->time=$ec[0]->time;
                   $plan37->repetition=$ec[0]->repetition;


                   $plan38 = new Plan();
                   $plan38->exercise_id=$ec[1]->exercise_id;
                   $plan38->time=$ec[1]->time;
                   $plan38->repetition=$ec[1]->repetition;

                   $plan39 = new Plan();
                   $plan39->exercise_id=$ec[2]->exercise_id;
                   $plan39->time=$ec[2]->time;
                   $plan39->repetition=$ec[2]->repetition;

                   $plan40 = new Plan();
                   $plan40->exercise_id=$ec[3]->exercise_id;
                   $plan40->time=$ec[3]->time;
                   $plan40->repetition=$ec[3]->repetition;

                   $plan37->user_id=$user_id;
                   $plan37->plan=$user_id;
                   $plan37->number_of_week=$j;
                   $plan38->user_id=$user_id;
                   $plan38->plan=$user_id;
                   $plan38->number_of_week=$j;
                   $plan39->user_id=$user_id;
                   $plan39->plan=$user_id;
                   $plan39->number_of_week=$j;
                   $plan40->user_id=$user_id;
                   $plan40->plan=$user_id;
                   $plan40->number_of_week=$j;

                   $plan37->save();
                   $plan38->save();
                   $plan39->save();
                   $plan40->save();
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

    public function getAllChallenge(){

        $challenges = Challenge::all();
        return response()->json([
            'data' => $challenges,
        ]);
    }

    public function getChallengeExercises($challenge_id){

        $challenge = Challenge::with('exercises')->findOrFail($challenge_id);

        return response()->json([
            'data' => $challenge->exercises
        ]);
    }



}
