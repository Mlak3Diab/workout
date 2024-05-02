<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\Muscle;
use App\Models\Plan;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Validator;

class TrainerOperationController extends Controller
{
    public function addProfilePicture(Request $request) {
        $trainer = auth()->user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $request->validate([
                'image' => 'image||mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            // التحقق مما إذا كان هناك صورة قديمة، إذا كانت هناك، احذفها
            if ($trainer->image) {
                Storage::delete($trainer->image);
            }
            // تخزين الصورة الجديدة وتحديث المسار في قاعدة البيانات
            $path = $image->store('image');
            $trainer->image = $path;
            $trainer->save();
            return response()->json(['message' => 'Profile picture updated successfully'], 200);
        } else {
            return response()->json(['error' => 'No image uploaded'], 400);
        }
    }


    public function getinfo(Request $request){
        $trainer_id=auth()->user()->id;
        $trainer=Trainer::where('id',$trainer_id)->first();
        return response()->json([
            'status'=>true,
            'data'=>$trainer,
        ]);
    }


    //add article -POST
     public function addarticle(Request $request){
        $trainer_id=auth()->user()->id;
        $request->validate([
            'title'=>'required|string|max:60',
            'body'=>'required|string',
            'image'=>'required|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $article=new Article();
        $article->title=$request->title;
        $article->body=$request->body;
        $article->image=$request->image;
        $article->trainer_id=$trainer_id;
        $article->save();
        return response()->json(['message'=>'your article added successfully']);
    }


    //get all article for trainer _GET
    public function getarticle(){
        $trainer_id=auth()->user()->id;
        $articles=Article::where('trainer_id',$trainer_id)->get();
        return response()->json([
            'message'=>'your articles',
            'areticles'=>$articles
        ]);
    }


    //delet article _DELETE
    public function deletearticle($article_id){
        $trainer_id=auth()->user()->id;
        $article=Article::where('id',$article_id)->first();
        $article_trainer=$article->trainer_id;
        if($trainer_id==$article_trainer)
        {
            $article->delete();
        return response()->json([
            'message'=>'your article is delete',
        ]);
        }
        else
        {
            return response()->json([
                'message'=>'unauthorized',
            ]);
        }
    }


    //edit username _POST
    public function editusername(Request $request){
        $trainer=auth()->user();
        $request->validate([ 'username'=>'required',]);
        $trainer->username=$request->username;
        $trainer->save();
        return response()->json([
            'message' => 'your name edit successfully ',
            'user' => $trainer,
        ]);
    }


    //get all exercises GET
    public function getallexercises(){
        $exercises=Exercise::all();
        return response()->json([
            'data'=>$exercises,
        ]);
    }

    // add chanllenge
    public function addChallenge(Request $request){

        $trainer_id=auth()->user()->id;
        $trainer=Trainer::where('id',$trainer_id)->first();

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|string',
            'total_calories' => 'nullable|integer',
            'total_time' => 'nullable|integer',
            'muscle' => 'required|in:abs,chest,arm,leg,shoulder and back',
            'level' => 'required|in:beginner,intermediate,advanced',
            'exercises' => 'array|required',
            'exercises.*.id' => 'exists:exercises,id',
            'exercises.*.time' => 'nullable|integer',
            'exercises.*.repetition' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create the challenge
        $challenge = new Challenge();
        $challenge->fill($request->except('exercises'));
        $challenge->update(['trainer_id' => $trainer_id]);
        $challenge->save();

        // Attach exercises
        foreach ($request->input('exercises') as $exercise) {
            $time = $exercise['time'] ?? 30;
            $challenge->exercises()->attach($exercise['id'], [
                'time' => $time,
                'repetition' => $exercise['repetition'] ?? null,
            ]);
        }


        $challenge->load('exercises');
        $totalCalories = $challenge->exercises()->sum('calories');
        $totalTime = $challenge->exercises()->sum('challenge_exercise.time');


        $challenge->update([
            'total_calories' => $totalCalories,
            'total_time' => $totalTime
        ]);

        return response()->json([
            'message' => 'Challenge created successfully'
        ], 201);

    }



}
