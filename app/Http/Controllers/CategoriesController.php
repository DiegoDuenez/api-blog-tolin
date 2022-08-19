<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

/**
 * Class description
 *
 * @author Brayan
 */
class CategoriesController extends Controller
{



    /**
     * Metodo para obtener las categorias o categoria especifica
     *
     * @param Int $id En caso de solicitar un recurso especifico (categoria), por defecto es nulo
     * @return Array array
     */
    public function get($id = null)
    {
        if($id){
            $categorie = Categories::findOrFail($id);
            return response()->json([
                'status' => '200',
                'data' => $categorie,
                'message' => ''
            ],200);
        }
        else{
            $categories = Categories::all();
            //return response()->json(['categoriesList' => $categories]);
            return response()->json([
                'status' => '200',
                'data' => $categories,
                'message' => ''
            ],200);
        }

    }



    /**
     * Metodo para registrar categoria
     *
     * @param Request $request Este parametro recibe el cuerpo de la petición
     * @return Array array
     */
    public function insert(Request $request)
    {
        if($request->validate([
            'category_name'=>'required|min:2|unique:categories,category_name'
        ],
        [
            'category_name.required' => 'Por favor proporciona un nombre a la categoria',
            'category_name.unique' => 'Este nombre de categoria ya existe',
        ]
        )){

            $categorie = Categories::create([
                'category_name' => $request->category_name,
            ]);

            return response()->json([
                'status' => '201',
                'data' => $categorie,
                'message' => 'Se ha creado la categoria ' . $categorie->category_name
            ],201);

        }
        else {

            return response()->json([
                'status' => '400',
                'data' => [],
                'message' => 'Ha fallado la creación de la categoria'
            ],400);

        }

    }



    /**
     * Metodo para actualizar categoria
     *
     * @param Request $request Este parametro recibe el cuerpo de la petición
     * @param Int $id Este pareametro recibe un numero entero (id) de la categoria a actualizar
     * @return Array array
     */
    public function update(Request $request,$id)
    {
        if ($request->validate([
            'category_name'=>'required|min:2|unique:categories,category_name'
        ],
        [
            'category_name.required' => 'Por favor proporciona un nombre a la categoria',
            'category_name.unique' => 'Este nombre de categoria ya existe',
        ]
        )){

            $categories = Categories::findOrFail($id);
            $categories->category_name = $request->category_name;

            if($categories->save()){

                return response()->json([
                    'status' => '200',
                    'data' => $categories,
                    'message' => ''
                ], 200);

            }
            else{

                return response()->json([
                    'status' => '400',
                    'data' => [],
                    'message' => 'No se actualizado la categoria'
                ], 400);

            }

        }
        else{

            return response()->json([
                'status' => '400',
                'data' => [],
                'message' => 'Ha fallado la petición'
            ], 400);

        }

    }



     /**
     * Metodo para elimianr categoria
     *
     * @param Int $id Este pareametro recibe un numero entero (id) de la categoria a eliminar
     * @return Array array
     */
    public function delete($id)
    {


        if($id){

            $categories = Categories::find($id);

            if($categories){

                if($categories->delete()){

                    return response()->json([
                        'status' => '200',
                        'data' => [],
                        'message' => 'Se ha eliminado la categoria'
                    ], 200);

                }
                else{

                    return response()->json([
                        'status' => '400',
                        'data' => [],
                        'message' => 'No se ha podido eliminar la categoria'
                    ], 400);

                }

            }
            else{

                return response()->json([
                    'status' => '404',
                    'data' => [],
                    'message' => 'No se encontro el recurso solicitado'
                ], 404);

            }
            return response()->json(['categoriesUpdateComplete']);

        }
        else{

            return response()->json([
                'status' => '400',
                'data' => [],
                'message' => 'Faltan parametros por enviar'
            ], 400);

        }

    }

    /*public function getId($id)
    {
        $Categories = Categories::findOrFail($id);
        if($Categories)
        {
            return response()->json(['categoriesList' => $Categories],202);
        }
        else{
            return response()->json(["Message" => "No se encuentra"],404);
        }
    }*/

}

