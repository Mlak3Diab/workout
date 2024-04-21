<?php

namespace App\Http\Controllers;

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
                'image' => 'image||mimes:jpeg,png,jpg,gif|max:2048'
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



}
