<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;


class VerificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:user-api')->only('resend');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verifyu(Request $request) {


        $user_id=$request->id;
       $user=User::findOrFail($user_id);
        if ($user->hasVerifiedEmail()) {
            return response(['message' => 'Email already verified '], 200);
        }
         if($user->markEmailAsVerified()){
             event(new Verified($request->user()));
        }

      $user->update(['email_verified_at' => now()]);

      return response()->json(['message' => 'Email verified successfully'], 200);
    }

    public function resend(Request $request) {
        $user_id=auth()->user()->id;
        $user=User::findOrFail($user_id);
        if ($user->hasVerifiedEmail()) {
            return response(["msg" => "Email already verified."], 400);
        }
        $user->sendEmailVerificationNotification();
        $user->update(['email_verified_at' => now()]);
        return response()->json(["msg" => "Email verification link sent on your email id"]);

    }

}
