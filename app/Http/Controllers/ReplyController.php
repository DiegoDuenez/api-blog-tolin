<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{

    public function __construct() {
        //$this->middleware('auth');
      }


    //pagina Reply
    public function get()
    {
        $reply = Reply::all();
        foreach($reply as $replyList) {
            $user = User::findOrFail($replyList['user_id']);
            $replyList['user_id']=$user->name;
        }
        return response()->json(['replyList' => $reply]);
    }

    public function getId($id)
    {
        $Reply = Reply::findOrFail($id);
        $user = User::findOrFail($Reply->user_id);
        $Reply->user_id=$user->name;

        if($Reply)
        {
            return response()->json(['ReplyList' => $Reply],202);
        }
        else{
            return response()->json(["Message" => "No se encuentra"],404);
        }
    }




    public function insert(Request $request)
    {
        if ($request->validate([
            'description'=>'required|min:1',
            'id_comment'=>'required',
            'id_user'=>'required'
        ]))
        {
            $reply=Reply::create([
                'description' => $request->description,
                'id_comment' => $request->id_comment,
                'id_user' => $request->id_user
            ]);
            return response()->json(['replyInsertComplete' => $reply]);

        }else {
            return response()->json(['replyInsertFalied'],401);
        }

    }




    public function update(Request $request,$id)
    {
        if ($request->validate([
            'description'=>'required|min:1',
            'id_comment'=>'required',
            'id_user'=>'required'
        ]))
        {
            $reply = Reply::findOrFail($id);
            $reply->description = $request->description;
            $reply->save();
            return response()->json(['replyUpdateComplete' => $reply]);
        }else
        {
            return response()->json(['replyUpdateFalied'],401);
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
            $deleted = Reply::where('reply.id', $id)
            ->delete();
            return response()->json(['replyDeleteComplete']);
        }else
        {
            return response()->json(['replyDeleteFalied'],401);
        }
    }




}

