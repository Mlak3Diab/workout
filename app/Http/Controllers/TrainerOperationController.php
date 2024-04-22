<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
