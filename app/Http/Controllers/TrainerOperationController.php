<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerOperationController extends Controller
{
    public function addProfilePicture(Request $request) {
        $user = auth()->user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
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
}
