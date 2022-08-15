<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/**
 * Class description
 *
 * @author Cisco
 */
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        $id = Auth::user()->id;
        $username = Auth::user()->name;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'id' => $id,
            'username' => $username,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|string|email|max:120|unique:users',
            'password'=>'required|string|min:6'

        ]);
        if($validator->fails())
        {
            return response()->json($validator->messages()->toJson(), 400);
            #return response()->json($validator->error()->toJson(),400);
        }
        $user=User::create(array_merge(
            $validator->validate(),
            ['password'=>bcrypt($request->password)]
        ))->assignRole('Normal');

        return response()->json([
            'status' => '200',
            'message' => 'Successfully authenticated',
            'Nombre' => $user->name,
            'email' => $user->email,
        ],201);
    }
}
