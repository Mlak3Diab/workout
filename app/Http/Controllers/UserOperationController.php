<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Weight;


class UserOperationController extends Controller
{
    //Make BMI - GET
    public function GetBMI(){
        //find the user
        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id);

        //find the weight and length
        $weight = Weight::where('user_id', $user_id)->latest()->first();
        $lastWeight = Weight::where('user_id', $user->id)->latest()->first();
        $length = $user->length;

        $bmi = $weight / ($length * $length);

        // Update user's BMI
        $user->BMI = $bmi;
        $user->save();

        return response()->json([
            'message' => 'BMI updated successfully',
            'BMI' => $bmi,
            'weight' => $weight
        ]);
    }

    // Add Weight - POST
    public function addWeight(Request $request){
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);

        $request->validate([
            "weight" => "required"
        ]);

        $weight = new Weight();
        $weight -> weight_value = $request -> weight;
        $weight -> user_id = $user_id;

        return response()->json([
            'message'=>'The Weight Added Succesfully'
            ]);

    }

}