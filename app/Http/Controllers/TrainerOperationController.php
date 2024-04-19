<?php

namespace App\Http\Controllers;

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
}
