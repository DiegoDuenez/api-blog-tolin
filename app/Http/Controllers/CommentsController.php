<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{

    public function __construct() {
        //$this->middleware('auth');
      }


    //pagina Comments
    public function get()
    {
        $Comments = Comments::all();
        foreach($Comments as $CommentsList) {
            $user = User::findOrFail($CommentsList['user_id']);
            $CommentsList['user_id']=$user->name;
        }
        return response()->json(['commentsList' => $Comments]);
    }

    public function getId($id)
    {
        $Comments = Comments::findOrFail($id);
        $user = User::findOrFail($Comments->user_id);
        $Comments->user_id=$user->name;

        if($Comments)
        {
            return response()->json(['CommentsList' => $Comments],202);
        }
        else{
            return response()->json(["Message" => "No se encuentra"],404);
        }
    }

    public function insert(Request $request)
    {
        if ($request->validate([
            'description'=>'required|min:1',
            'id_post'=>'required',
            'id_user'=>'required'
        ]))
        {
            $Comments=Comments::create([
                'description' => $request->description,
                'id_post' => $request->nombreCategoria,
                'id_user' => $request->id_user
            ]);
            return response()->json(['commentInsertComplete' => $Comments]);

        }else {
        return response()->json(['commentInsertFalied'],401);
        }

    }



    public function update(Request $request,$id)
    {
        if ($request->validate([
            'description'=>'required|min:1',
            'id_post'=>'required',
            'id_user'=>'required'
        ]))
        {
        $Comments = Comments::findOrFail($id);
        $Comments->description = $request->description;
        $Comments->save();
        return response()->json(['commentUpdateComplete' => $Comments]);
    }else {
    return response()->json(['commentUpdateFalied'],401);
    }

}


    public function delete(Request $request,$id)
    {
        if ($request->validate([
            'description'=>'required|min:1',
            'id_post'=>'required',
            'id_user'=>'required'
        ]))
        {
            $deleted = Comments::where('Comments.id', $id)
            ->delete();
            return response()->json(['commentDeleteComplete']);
        }else
        {
            return response()->json(['commentDeleteFalied'],401);
        }
    }


}

