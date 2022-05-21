<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    public function response($user)
    {
        $token = $user->createToken(str()->random(40))->plainTextToken;
        return response()->json([
            'user'=>$user,
            'token'=>$token,
            'token_type'=>'Bearer'
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|min:3|email',
            'password'=>'required|min:3',

        ]);
        $user=User::create([
            'name'=>ucwords($request->name),
            'email'=>$request->email,
            'password'=>bcrypt($request->password),

        ]);
        return $this->json([
            'user'=>$user,
            'token_type'=>'Bearer'
        ]);
    }
    public function login(Request $request)
    {
        $cred = $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required|min:3'
        ]);
        if(!Auth::attempt($cred)){
            return response()->json(['message' =>'Unauthorized'],401);

        }
return $this->response( Auth::user() );
    }
    public function logout(){
        Auth::user()->tokens()->delete();
        return response()->json(['message' =>'You have successfully logged out and token was succefull deleted']);
    }
}
