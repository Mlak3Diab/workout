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
        return User::find($user_id);
    }

//we want send notifications to multi users
    public function sendnotificationsmulti(Request $request){
        $user_ids=$request->user_ids;
        //we take tokens of all ids users
        $fcm_tokens=User::find($user_ids)->pluck('fcm_token');
        $server_key=env('FCM_SERVER_KEY');
        $fcm=Http::acceptJson()->withToken($server_key)->post(
            'https://fcm.googleapis.com/fcm/send',
            [
                //token user
                'registration_ids'=>$fcm_tokens,
                'notification'=>[
                    'title'=>'hello',
                    'body'=>'welcome in my app'
                ]
            ]
        );
        return json_decode($fcm);


    }

}
