<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //

    public function get()
    {
        $Post = Post::all();
        return response()->json(['postList' => $Post]);
    }


    public function insert(Request $request)
    {
        if ($request->validate([
            'title'=>'required',
            'description'=>'required',
            'user_id'=>'required'
        ]))
        {
            $Post=Post::create([
                'post' => $request->post,
                'description'=>$request->description,
                'user_id'=>$request->user_id
            ]);
            return response()->json(['postInsertComplete' => $Post]);

        }else {
            return response()->json(['postInsertFalied'],401);
        }

    }




    public function update(Request $request,$id)
    {
        if ($request->validate([
            'title'=>'required',
            'description'=>'required',
            'user_id'=>'required'
        ]))
        {
            $Post = Post::findOrFail($id);
            $Post->title = $request->title;
            $Post->description = $request->description;
            $Post->save();
            return response()->json(['PostUpdateComplete' => $Post]);
        }else
        {
            return response()->json(['PostUpdateFalied'],401);
        }
    }


    public function delete(Request $request,$id)
    {
        if ($request->validate([
            'id'=>'required|min:1'
        ]))
        {
            Post::where('id', $id)
            ->delete();
            return response()->json(['PostDeleteComplete']);
        }else
        {
            return response()->json(['PostDeleteFalied'],401);
        }
    }

}
