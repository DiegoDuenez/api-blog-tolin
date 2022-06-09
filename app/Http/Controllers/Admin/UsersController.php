<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUsers(){
        $Users = User::all();
        return response()->json([
            'status' => 200,
            'data' => $Users,
            'message' => "successfully"
        ],200);
    }

    public function getUser($id){
        $Users = User::findOrFail($id);
        if($Users)
        {
            return response()->json([
                'status' => 200,
                'data' => $Users,
                'message' => "successfully"
            ],202);
        }
        else{
            return response()->json(["Message" => "No se encuentra"],404);
        }

    }

    public function CountUsers(){
        $Users = User::all()->count();
        return response()->json([
            'status' => 200,
            'data' => $Users,
            'message' => "successfully"
        ],202);
    }

    public function getRol(){
        $usuario = Auth::user();

        $all_users_with_all_their_roles = User::with('roles')->get();

        return response()->json([
            'status' => 200,
            'data' => $all_users_with_all_their_roles,
            'message' => "successfully"
        ],202);
    }

    public function whois()
    {
        $user = User::find(Auth::id());
        $Casmen2= $user->can('Admins');
        $Casmen= $user->getRoleNames();
        $Casmen3=$user->getPermissionNames();

        $prueba = $user->hasRole('Admin');

        return response()->json(['message'=>$prueba]);

        return response()->json(['message'=>$Casmen, 'messag2' =>$Casmen2,'message3' =>$Casmen3]);

        if($Casmen)
        {
            return 'si es';
        }
        else
        {
            return 'no es';
        }

    }

}
