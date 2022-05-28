<?php

use App\Http\Controllers\Authentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',[Authentication::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
Route::post('logout',[Authentication::class,'logout']);
Route::get('user',function(Request $request){
    return $request->user();
});

});
Route::post('register',[Authentication::class,'register']);


//Cisco_Login
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh',[AuthController::class,'refresh']);
    Route::post('me',[AuthController::class,'me']);
    Route::post('register', [AuthController::class,'register']);

});

//rutas prueba brayan
                        //en fase de pruebas
Route::get('catGet',[CategoriesController::class,'get']);
Route::post('catInsert',[CategoriesController::class,'insert']);
Route::put('catUpdate/{id}',[CategoriesController::class,'update']);
Route::delete('catDelete/{id}',[CategoriesController::class,'delete']);
Route::get('catGet/{id}',[CategoriesController::class,'getCategorie']);
                        //en fase de pruebas
