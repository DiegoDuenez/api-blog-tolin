<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



/**
 * Class description
 *
 * @author Luis
 */
class Authentication extends Controller
{


    /**
     * Metodo para generar una respuesta de token
     * 
     * @return Array array
     */
    public function response($user)
    {
        $token = $user->createToken(str()->random(40))->plainTextToken;
        return response()->json([
            'token'=>$token,
        ]);

    }



    /**
     * Metodo para registrar un usuario
     * 
     * @param Request $request Este parametro recibe el cuerpo de la petición
     * @return Array array
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|min:3|email',
            'password'=>'required|min:3',
        ]);

        $user = User::create([
            'name'=>ucwords($request->name),
            'email'=>$request->email,
            'password'=>bcrypt($request->password),

        ]);

        return response()->json([
            'status' => '201',
            'data' => [],
            'message' => 'Se ha creado tu cuenta'
        ],201);

    }



    /**
     * Metodo para logearse
     * 
     * @param Request $request Este parametro recibe el cuerpo de la petición
     * @return Array array
     */
    public function login(Request $request)
    {
        $cred = $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required|min:3'
        ]);

        if(!Auth::attempt($cred)){

            return response()->json([
                'status' => '401',
                'data' => [],
                'message' => 'Los datos ingresados son incorrectos'
            ],401);

        }

        return $this->response(Auth::user());

    }



    /**
     * Metodo para cerrar sesión
     * 
     * @return Array array
     */
    public function logout(){

        Auth::user()->tokens()->delete();

        return response()->json([
            'status' => '200',
            'data' => [],
            'message' => 'Se ha cerrado sesión'
        ],200);

    }
}
