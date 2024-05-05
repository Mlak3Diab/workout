<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationControllerTrainer extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:trainer-api')->only('resendt');
        $this->middleware('signed')->only('verifyt');
        $this->middleware('throttle:6,1')->only('verifyt', 'resendt');
    }

    public function verifyt(Request $request) {


        $trainer_id=$request->id;
        $trainer=Trainer::findOrFail($trainer_id);
        if ($trainer->hasVerifiedEmail()) {
            return response(['message' => 'Email already verified '], 200);
        }
        if($trainer->markEmailAsVerified()){
            event(new Verified($request->user()));
        }

        $trainer->update(['email_verified_at' => now()]);

        return response()->json(['message' => 'Email verified successfully'], 200);
    }

    public function resendt(Request $request) {
        $trainer_id=auth()->user()->id;
        $trainer=Trainer::findOrFail($trainer_id);
        if ($trainer->hasVerifiedEmail()) {
            return response(["msg" => "Email already verified."], 400);
        }

        $trainer->sendEmailVerificationNotification();
        $trainer->update(['email_verified_at' => now()]);
        return response()->json(["msg" => "Email verification link sent on your email id"]);

    }
}
