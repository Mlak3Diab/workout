<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    //for phone app
    public function register(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:users',
           'password' => 'required|min:6',
        ]);
        $user=new User();
        $user->username=$request->username;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json([
            'status'=>1,
            'massage'=>'You Are Registered Successfully '
        ]);
    }
    public function login(Request $request){
       $data= $request->validate([
            'email'=>'required',
            'password' => 'required',]);
       if(!auth()->attempt($data)){
           return response()->json([
               'status'=>0,
               'massage'=>'Unauthorized !'
           ]);}
       $token=auth()->user()->createToken('user_Token')->plainTextToken;
        return response()->json([
            'status'=>1,
            'massage'=>'you are logged in successfully',
            'token'=>$token,
        ]);
        
    }

}
