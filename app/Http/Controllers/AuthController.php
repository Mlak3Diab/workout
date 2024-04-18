<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Weight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\verified;
use Illuminate\Auth\Events\Registered;


class  AuthController extends Controller
{
  public function userRegister(Request $request)
  {
        $request->validate([
          'username'=>'required',
          'email'=>'required|email|unique:users',
          'password' => ['required',
              'min:6',             // must be at least 10 characters in length
              'regex:/[a-z]/',      // must contain at least one lowercase letter
              'regex:/[0-9]/',      // must contain at least one digit
              'regex:/[@$!%*#?&]/', // must contain a special character
          ],
          'weight' => 'required',
          'length' => 'required',
          'age' => 'required|integer',
        ]);
        $input=$request->all();
        $input['password']=bcrypt($input['password']);
        $input['activation_token']=Str::random(60);
        $user=User::query()->create($input);
        $accesstoken= $user->createToken('MyApp',['user'])->accessToken;

        Weight::create([
        'weight_value' => $request->input('weight'),
        'user_id' => $user->id,
        ]);

        return response()->json([
          'user'=>$user,
          'access_Token' => $accesstoken,
        ]);
  }

  public function userLogin(Request $request){
     $request->validate([
          'email'=>'required',
          'password' => 'required',
         ]);
     if(auth()->guard('user')->attempt($request->only('email','password'))) {
         config(['auth.guards.api.provider' => 'user']);
         $user = User::query()->select('users.*')->find(auth()->guard('user')->user()->id);
         $success = $user;
         $success['token'] = $user->createToken('MyApp', ['user'])->accessToken;
         return response()->json($success);

     }
     else{
         return response()->json(['message'=>'Unauthorized'],401);
     }
  }
  public function userLogout(){
      Auth::guard('user-api')->user()->token()->revoke();
      return response()->json([
          'success' => 'logged out successfully'
      ]);
      }
  public function userForgetPassword(Request $request){
        $data = $request->validate([
            'email'=>'required|email|exists:users',
        ]);
        //delete all old code that user send before
        ResetCodePassword::query()->where('email', $request['email'])->delete();

        //generate random code
        $data['code']= mt_rand(100000 , 999999);

        // create a new code
        $codeData= ResetCodePassword::query()->create($data);

        //send email to user
        Mail::to($request['email'])->send(new SendCodeResetPassword($codeData['code']));

        return response()->json([
            'message' => trans('code.sent')
        ]);

    }
  public function userCheckCode(Request $request){
        $request->validate([
            'code'=>'required|string|exists:reset_code_passwords',
        ]);
        //find the code
        $passwordReset= ResetCodePassword::query()->firstWhere('code',$request['code']);

        //check if it is not expired the is one hour
        if($passwordReset['created_at'] > now()->addHour()){
            $passwordReset->delete();
            return response()->json([
                'message' => trans('passwords.code.is.expire')
            ],422);
        }
        return response()->json([
            'code' => $passwordReset['code'],
            'message' => trans('passwords.code.is.valid'),
        ]);
    }
  public function userResetPassword(Request $request){
        $input = $request->validate([
            'code'=>'required|string|exists:reset_code_passwords',
            'password' => ['required',
                'min:6',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);
        $passwordReset = ResetCodePassword::query()->firstWhere('code', $request['code']);

        //check if it is not expired
        if($passwordReset['created_at'] > now()->addHour()){
            $passwordReset->delete();
            return response()->json([
                'message' => trans('passwords.code.is.expire')
            ],422);
        }
        //find user email
        $user = \App\Models\User::query()->firstWhere('email', $passwordReset['email']);

        //update user password
        $input['password'] = bcrypt($input['password']);
        $user->update([
            'password' => $input['password'],
        ]);
        //delete current code
        $passwordReset->delete();

        return response()->json(['message'=> 'password has been successfully reset ']);

    }

    /*
    public function sendVerificationEmail(Request $request){

        if($request->user()->hasVerifiedEmail()){
            return response()->json([
                'message' => 'Already Verified'
            ]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'verification-link-sent'
        ]);
    }


    public function verify(EmailVerificationRequest $request){
        if($request->user()->hasVerifiedEmail()){
            return response()->json([
                'message' => 'Already Verified'
            ]);
        }
        if($request->user()->markEmailAsVerified()){
            event(new Verified($request->user()));
        }

        return response([
            'message' => 'Email Has Been Verified'
        ]);

    }
    */

//////////////////////////////////////
/// for trainer web
  public function trainerRegister(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:trainers',
            'password' => ['required',
                'min:6',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'cv' => 'required',
        ]);
        $input=$request->all();
        $input['password']=bcrypt($input['password']);
        $input['activation_token']=Str::random(60);

        $trainer=Trainer::query()->create($input);
        $accesstoken= $trainer->createToken('MyApp',['trainer'])->accessToken;
        return response()->json([
            'trainer'=>$trainer,
            'access_Token' => $accesstoken,
        ]);
    }
  public function trainerLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password' => 'required',
        ]);
        if(auth()->guard('trainer')->attempt($request->only('email','password'))) {
            config(['auth.guards.api.provider' => 'trainer']);
            $trainer = Trainer::query()->select('trainers.*')->find(auth()->guard('trainer')->user()['id']);
            $success = $trainer;
            $success['token'] = $trainer->createToken('MyApp', ['trainer'])->accessToken;
            return response()->json($trainer);

        }
        else{
            return response()->json(['message'=>'Unauthorized'],401);
        }
    }
  public function trainerLogout(){
        Auth::guard('trainer-api')->user()->token()->revoke();
        return response()->json([
            'success' => 'logged out successfully'
        ]);
    }
  public function trainerForgetPassword(Request $request){
        $data = $request->validate([
            'email'=>'required|email|exists:trainers',
        ]);
        //delete all old code that user send before
        ResetCodePassword::query()->where('email', $request['email'])->delete();

        //generate random code
        $data['code']= mt_rand(100000 , 999999);

        // create a new code
        $codeData= ResetCodePassword::query()->create($data);

        //send email to user
        Mail::to($request['email'])->send(new SendCodeResetPassword($codeData['code']));

        return response()->json([
            'message' => trans('code.sent')
        ]);

    }
  public function trainerCheckCode(Request $request){
        $request->validate([
            'code'=>'required|string|exists:reset_code_passwords',
        ]);
        //find the code
        $passwordReset= ResetCodePassword::query()->firstWhere('code',$request['code']);

        //check if it is not expired the is one hour
        if($passwordReset['created_at'] > now()->addHour()){
            $passwordReset->delete();
            return response()->json([
                'message' => trans('passwords.code.is.expire')
            ],422);
        }
        return response()->json([
            'code' => $passwordReset['code'],
            'message' => trans('passwords.code.is.valid'),
        ]);
    }
  public function trainerResetPassword(Request $request){
        $input = $request->validate([
            'code'=>'required|string|exists:reset_code_passwords',
            'password' => ['required',
                'min:6',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);
        $passwordReset = ResetCodePassword::query()->firstWhere('code', $request['code']);

        //check if it is not expired
        if($passwordReset['created_at'] > now()->addHour()){
            $passwordReset->delete();
            return response()->json([
                'message' => trans('passwords.code.is.expire')
            ],422);
        }
        //find user email
        $user =Trainer::query()->firstWhere('email', $passwordReset['email']);

        //update user password
        $input['password'] = bcrypt($input['password']);
        $user->update([
            'password' => $input['password'],
        ]);
        //delete current code
        $passwordReset->delete();

        return response()->json(['message'=> 'password has been successfully reset ']);
    }

}
