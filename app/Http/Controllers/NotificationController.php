<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function refreshtoken(Request $request){
        $user_id=auth()->user()->id;
        $fcm_token=$request->fcm_token;
        User::where('id',$user_id)->update(['fcm_token'=>$fcm_token]);
        return response()->json([
            'data'=>User::find($user_id)
        ],200);
    }

}
