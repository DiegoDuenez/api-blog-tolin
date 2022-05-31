<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUsers(){
        $Users = User::all();
        return response()->json(['Users' => $Users]);
    }

    public function getUser($id){
        $Users = User::findOrFail($id);
        if($Users)
        {
            return response()->json(['User' => $Users],202);
        }
        else{
            return response()->json(["Message" => "No se encuentra"],404);
        }

    }

    public function CountUsers(){
        $Users = User::all()->count();
        return response()->json(['UserCount' => $Users],202);
    }

}
