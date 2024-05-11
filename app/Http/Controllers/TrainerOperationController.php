<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\Muscle;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Challenge;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Validator;

class TrainerOperationController extends Controller
{
    public function addProfilePicture(Request $request) {
        $trainer = auth()->user();
        $request->validate([
            'image' => 'image||mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');

                $profile_image=time() . '.' .$image->getClientOriginalExtension();
                $image->move(public_path('trainer_profile_images'),$profile_image);
                $profile_image='trainer_profile_images/'.$profile_image;
        $trainer->image=$profile_image;
        $trainer->save();
            return response()->json(['message' => 'Profile picture updated successfully'], 200);
        } else {
            return response()->json(['error' => 'No image uploaded'], 400);
        }
    }
    public function deleteprofile(){
        $trainer = auth()->user();
        $trainer->image=null;
        $trainer->save();
        return response()->json(['message' => 'Profile picture deleted successfully'], 200);
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
         if ($request->hasFile('image')) {
             $image = $request->file('image');

             $article_image = time() . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('article_images'), $article_image);
             $article_image = 'article_images/' . $article_image;
             $article->image = $article_image;
             $article->title = $request->title;
             $article->body = $request->body;
             $article->trainer_id = $trainer_id;
             $article->save();
             return response()->json(['message' => 'your article added successfully']);
         }
         else{
             return response()->json(['error' => 'No image uploaded'], 400);
         }
    }


    //get all article for trainer _GET
    public function getarticle(){
        $trainer_id=auth()->user()->id;
        $articles=Article::where('trainer_id',$trainer_id)->get();
        return response()->json([
            'message'=>'your articles',
            'articles'=>$articles
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
            'message'=>'your article is delete',]);}
        else {            return response()->json([
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
            'exercises.*.week' => 'required|integer|in:1,2,3,4',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create the challenge
        $challenge = new Challenge();
        $challenge->fill($request->except('exercises'));
        $challenge->trainer_id=$trainer_id;
        $challenge->save();

        // Attach exercises
        foreach ($request->input('exercises') as $exercise) {
            $time = $exercise['time'] ?? 30;
            $week = $exercise['week'] ?? null;
            $challenge->exercises()->attach($exercise['id'], [
                'time' => $time,
                'repetition' => $exercise['repetition'] ?? null,
                'week' => $week,
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


    public function getTranierChallenge(){
        $trainer_id=auth()->user()->id;
        $challenges = Challenge::where('trainer_id',$trainer_id)->get();

        return response()->json([
            'data' => $challenges,
        ]);
    }

    public function getChallengeData($challenge_id){
        $challenge = Challenge::where('id',$challenge_id)->first();
        $exercises = $challenge->exercises()->get();

        return response()->json([
            'data' => $exercises,
        ]);
    }


    public function deleteChallenge($challengeId)
    {
        // Retrieve the challenge with the given ID
        $challenge = Challenge::findOrFail($challengeId);

        // Delete all associated exercises
        $challenge->exercises()->detach();

        // Delete the challenge itself
        $challenge->delete();

        return response()->json([
            'message' => 'Challenge deleted successfully'
        ]);
    }


    public function getUserEnrolledChallengesByTrainer()
    {
        $trainerId=auth()->user()->id;

     // Retrieve challenges created by the given trainer
    $challenges = Challenge::where('trainer_id', $trainerId)->get();

    // Initialize an empty collection to store enrolled users
    $enrolledUsers = collect();

    // Iterate through the challenges and retrieve users enrolled in each challenge
    foreach ($challenges as $challenge) {

        $users = $challenge->users()->get();
        foreach ($users as $user) {
            if (!$enrolledUsers->contains('id', $user->id)) {
                $enrolledUsers->push($user);
            }
    }
}
        return response()->json([
            'message' => 'the user enrolled in trainer challenge',
            'data' => $enrolledUsers
        ], 200);
    }

    public function addproduct(Request $request){
        $trainer_id=auth()->user()->id;
        $request->validate([
            'image' => 'required|image||mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string',
            'price' => 'required|numeric|min:1',

        ]);
        $product=new Product();
        $image=$request->file('image');
        $product_image=null;
        if ($request->hasFile('image')) {

            $product_image=time() . '.' .$image->getClientOriginalExtension();
            $image->move(public_path('product_images'),$product_image);
            $product_image='product_images/'.$product_image;
        }
        $product->image = $product_image;
        $product->price=$request->price;
        $product->name=$request->name;
        $product->trainer_id=$trainer_id;
        $product->save();

        return response()->json([
            'message'=>'your product added successfully',
        ],200);
    }
    public function deleteproduct($product_id){
        $product=Product::where('id',$product_id)->first();
        $product->delete();
        return response()->json([
            'message'=>'your product deleted successfully',
        ],200);
    }
    public function getproductstrainer(){
        $trainer_id=auth()->user()->id;
        $products=Product::where('trainer_id',$trainer_id)->get();
        return response()->json([
            'message'=>'your products',
            'products'=>$products,
        ]);
    }

}
