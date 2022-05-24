<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function __construct() {
        //$this->middleware('auth');
      }


    //pagina categories
    public function get()
    {
        $categories = Categories::all();
        return response()->json(['categoriesList' => $categories]);
    }


    public function insert(Request $request)
    {
        if ($request->validate([
            'category_name'=>'required|min:2'
        ]))
        {
            $categories=Categories::create([
                'category_name' => $request->category_name,
            ]);
            return response()->json(['categoriesInsertComplete' => $categories]);

        }else {
        return response()->json(['categoriesInsertFalied'],401);
        }

    }



    public function update(Request $request,$id)
    {
        if ($request->validate([
            'category_name'=>'required|min:2'
        ]))
        {
            $categories = Categories::findOrFail($id);
            $categories->category_name = $request->category_name;

            $categories->save();
            return response()->json(['categoriesUpdateComplete' => $categories]);

        }else
        {
            return response()->json(['categoriesUpdateFalied'],401);
        }

    }





    public function delete(Request $request,$id)
    {
        if ($request->validate([
            'category_name'=>'required|min:2'
        ]))
        {
            $categories = Categories::where('categories.id', $id)
            ->delete();
            return response()->json(['categoriesUpdateComplete']);
        }else
        {
            return response()->json(['categoriesDeleteFalied'],401);
        }



    }

}

