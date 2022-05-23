<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

      }


    //pagina Comments
    public function get()
    {
      $Comments = DB::table('comments')->get();
      return response()->json(['commentsList' => $Comments]);
    }


    public function insert(Request $request)
    {
        if ($request->validate([
            'description'=>'required|min:1',
            'id_post'=>'required',
            'id_user'=>'required'
        ]))
        {
            $Comments=comments::create([
                'description' => $request->description,
                'id_post' => $request->nombreCategoria,
                'id_user' => $user->id
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
        $Comments = comments::findOrFail($id);
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
            $deleted = DB::table('comments')
            ->where('Comments.id', $id)
            ->delete();
            return response()->json(['commentDeleteComplete']);
        }else
        {
            return response()->json(['commentDeleteFalied'],401);
        }
    }

}

