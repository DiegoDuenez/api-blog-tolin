<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

    public function getComentid($id)
    {
        $Post = Post::findOrFail($id);
        $Comments = Comments::where('post_id',$Post->id)->get();
        foreach($Comments as $Commentslist) {
            $user = User::findOrFail($Commentslist['user_id']);
            //$postList['created_at']=$Post->created_at->format('d/m/Y');
            $Commentslist['user_id']=$user->name;
        }
        if($Comments)
        {
            return response()->json(['CommentsList' => $Comments,'total'=> $Comments->count()],202);
        }
        else{
            return response()->json(["Message" => "No se encuentra"],404);
        }
    }


    public function insert(Request $request,$id)
    {
        $Post = Post::findOrFail($id);

        if($Post){
            $user = Auth::user();
        if ($request->validate([
            'description'=>'required|min:1',
        ]))
        {

            $Comments=Comments::create([
                'description' => $request->description,
                'post_id' => $id,
                'user_id' => $user->id
            ]);
            return response()->json(['commentInsertComplete' => $Comments]);

        }else {
        return response()->json(['commentInsertFalied'],401);
        }
        }else{
            return response()->json(['No exite'],401);
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

