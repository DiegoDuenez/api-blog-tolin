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

}
