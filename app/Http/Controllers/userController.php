<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use App\Models\trainer;
use App\Models\User;
use App\Models\weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class userController extends Controller
{
    //for phone app
   /*
   public function register(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:users',
           'password' => 'required|min:6',
            'weight' => 'required',
            'length' => 'required',
            'age' => 'required|integer',
        ]);
        $user=new User();
        $user->username=$request->username;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->weight=$request->weight;
        $user->length=$request->length;
        $user->age=$request->age;
        $user->save();
        $weight=new weight();
        $weight->weight_value=$user->weight;
        $weight->user_id=$user->id;
        $weight->save();
        return response()->json([
            'status'=>1,
            'message'=>'You Are Registered Successfully '
        ]);
    }
    public function registerforweb(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:users',
            'password' => 'required|min:6',
            'cv' => 'required|string',
        ]);
        $trainer=new trainer();
        $trainer->username=$request->username;
        $trainer->email=$request->email;
        $trainer->password=bcrypt($request->password);
        $trainer->cv=$request->cv;
        $trainer->save();
        return response()->json([
            'status'=>1,
            'message'=>'You Are Registered Successfully '
        ]);

    }
    public function login(Request $request){
       $data= $request->validate([
            'email'=>'required',
            'password' => 'required',]);
       if(!auth()->attempt($data)){
           return response()->json([
               'status'=>0,
               'message'=>'Unauthorized !'
           ]);}
       $token=auth()->user()->createToken('user_Token')->plainTextToken;
        return response()->json([
            'status'=>1,
            'message'=>'you are logged in successfully',
            'token'=>$token,
        ]);

    }
    ///not done
    public function loginforweb(Request $request){
        $data= $request->validate([
            'email'=>'required',
            'password' => 'required',]);
        if(!auth()->attempt($data)){
            return response()->json([
                'status'=>0,
                'message'=>'Unauthorized !'
            ]);}
        $token=trainer::class->createToken('user_Token')->plainTextToken;
        return response()->json([
            'status'=>1,
            'message'=>'you are logged in successfully',
            'token'=>$token,
        ]);

    }*/
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
            'password' => 'required|min:6'
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

}
