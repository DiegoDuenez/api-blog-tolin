<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

      }


    //pagina Reply
    public function get()
    {
      $reply = DB::table('reply')->get();
      return response()->json(['replyList' => $reply]);
    }




    public function insert(Request $request)
    {
        if ($request->validate([
            'description'=>'required|min:1',
            'id_comment'=>'required',
            'id_user'=>'required'
        ]))
        {
            $reply=reply::create([
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
            $reply = reply::findOrFail($id);
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
            $deleted = DB::table('reply')
            ->where('reply.id', $id)
            ->delete();
            return response()->json(['replyDeleteComplete']);
        }else
        {
            return response()->json(['replyDeleteFalied'],401);
        }
    }

}

