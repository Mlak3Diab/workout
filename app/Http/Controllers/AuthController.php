<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeResetPassword;
use App\Mail\sendcodeverificationemail;
use App\Models\email_verification_code;
use App\Models\ResetCodePassword;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;



class  AuthController extends Controller
{
  public function userRegister(Request $request)
  {
        $user=$request->validate([
          'username'=>'required',
          'email'=>'required|email|unique:users',
          'password' => ['required',
              'min:6',             // must be at least 10 characters in length
              'regex:/[a-z]/',      // must contain at least one lowercase letter
              'regex:/[0-9]/',      // must contain at least one digit
              'regex:/[@$!%*#?&]/', // must contain a special character
          ],
          'weight' => 'required|numeric|min:1',
          'length' => 'required|numeric|min:1|integer',
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
      //generate random code
      $data['code']= mt_rand(10000 , 99999);
      $data['email']=$user->email;

      // create a new code
      $codeData= email_verification_code::query()->create($data);

      //send email to user
      Mail::to($user->email)->send(new sendcodeverificationemail($codeData['code']));

      return response()->json([
          'messsage' =>'User registered successfully. Please verify your email by code ',
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
        $data['code']= mt_rand(10000 , 99999);

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
        $user = User::query()->firstWhere('email', $passwordReset['email']);

        //update user password
        $input['password'] = bcrypt($input['password']);
        $user->update([
            'password' => $input['password'],
        ]);
        //delete current code
        $passwordReset->delete();

        return response()->json(['message'=> 'password has been successfully reset ']);

    }

    public function userCheckCodeemailverification(Request $request){
        $request->validate([
            'code'=>'required|string|exists:email_verification_codes',
        ]);
        //find the code
        $verifyemail= email_verification_code::query()->firstWhere('code',$request['code']);
        $user = User::where('email', $verifyemail['email'])->first();


        //check if it is not expired the is one hour
        if($verifyemail['created_at'] > now()->addHour()){
            $verifyemail->delete();
            return response()->json([
                'message' => trans('code.is.expire')
            ],422);
        }
        else{
            $user->email_verified_at=now();
            $user->save();
        return response()->json([
            'code' => $verifyemail['code'],
            'message' => trans('code.is.valid'),
        ]);}
    }

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

        //generate random code
        $data['code']= mt_rand(10000 , 99999);
        $data['email']=$trainer->email;

        // create a new code
        $codeData= email_verification_code::query()->create($data);

        //send email to user
        Mail::to($trainer->email)->send(new sendcodeverificationemail($codeData['code']));

        return response()->json([
            'message'=>'Trainer registered successfully. Please verify your email by code',
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
        $data['code']= mt_rand(10000 , 99999);

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

    public function trainerCheckCodeemailverification(Request $request){
        $request->validate([
            'code'=>'required|string|exists:email_verification_codes',
        ]);
        //find the code
        $verifyemail= email_verification_code::query()->firstWhere('code',$request['code']);
        $trainer = Trainer::where('email', $verifyemail['email'])->first();


        //check if it is not expired the is one hour
        if($verifyemail['created_at'] > now()->addHour()){
            $verifyemail->delete();
            return response()->json([
                'message' => trans('code.is.expire')
            ],422);
        }
        else{
            $trainer->email_verified_at=now();
            $trainer->save();
            return response()->json([
                'code' => $verifyemail['code'],
                'message' => trans('code.is.valid'),
            ]);}
    }
}
