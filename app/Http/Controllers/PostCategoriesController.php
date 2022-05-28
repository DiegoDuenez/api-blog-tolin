<?php

namespace App\Http\Controllers;
use App\Models\Post_categories;

use Illuminate\Http\Request;

class PostCategoriesController extends Controller
{
    
    public function get()
    {
        $Post_categories = Post_categories::all();
        return response()->json(['postCategoriesList' => $Post_categories]);
    }


    public function insert(Request $request)
    {
        if ($request->validate([
            'post'=>'required',
            'categories'=>'required'
        ]))
        {
            $Post_categories=Post_categories::create([
                'post' => $request->post,
                'categories' => $request->categories
            ]);
            return response()->json(['postInsertComplete' => $Post_categories]);

        }else {
            return response()->json(['postInsertFalied'],401);
        }

    }




    public function update(Request $request,$id)
    {
        if ($request->validate([
            'post'=>'required',
            'categories'=>'required'
        ]))
        {
            $Post_categories = Post_categories::findOrFail($id);
            $Post_categories->description = $request->description;
            $Post_categories->save();
            return response()->json(['Post_categoriesUpdateComplete' => $Post_categories]);
        }else
        {
            return response()->json(['Post_categoriesUpdateFalied'],401);
        }
    }


    public function delete(Request $request,$id)
    {
        if ($request->validate([
            'id'=>'required|min:1'
        ]))
        {
            $deleted = Post_categories::where('id', $id)
            ->delete();
            return response()->json(['Post_categoriesDeleteComplete']);
        }else
        {
            return response()->json(['Post_categoriesDeleteFalied'],401);
        }
    }
    
    public function getId($id)
    {
        $Post_categories = Post_categories::findOrFail($id);
        if($Post_categories)
        {
            return response()->json(['Post_categoriesList' => $Post_categories],202);
        }
        else{
            return response()->json(["Message" => "No se encuentra"],404);
        }
    }

}
