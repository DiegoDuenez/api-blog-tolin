<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function prueba()
    {
        $Post=User::inRandomOrder()->first();
        return $Post->id;
    }


    public function get()
    {
        $Post = Post::orderBy('created_at','DESC')->get();
        //return response()->json(['postList' => $Post]);
        //$cas = $Post->created_at->format('d/m/Y');
        //return response()->json(['postList' =>$Post->['created_at']]);
        foreach($Post as $postList) {
            $user = User::findOrFail($postList['user_id']);
            //$postList['created_at']=$Post->created_at->format('d/m/Y');
            $postList['user_id']=$user->name;
        }

        return response()->json(['postList' => $Post]);
    }

    public function getId($id)
    {
        $Post = Post::findOrFail($id);
        $user = User::findOrFail($Post->user_id);
        $Post->user_id=$user->name;

        if($Post)
        {
            return response()->json(['PostList' => $Post],202);
        }
        else{
            return response()->json(["Message" => "No se encuentra"],404);
        }
    }



    public function insert(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validated)
        {
           // return response()->json(['postInsertComplete' => 'adios' ]);
            $Post=Post::create([
                'title' => $request->title,
                'description'=>$request->description,
                'user_id'=>$user->id
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
