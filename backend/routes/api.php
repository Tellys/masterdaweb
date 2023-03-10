<?php

use App\Http\Controllers\API\PedidosController;
use App\Http\Controllers\API\PedidosProdutosController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function(){return response()->json([
    "Tudo Certo com sua API"
]);});

Route::get('/login', function () {
    return json_encode('Faça o Login');
});

Route::get('/loout', function () {
    return json_encode('Faça o Login');
});


Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'logout');
    //Route::resource('products', ProductController::class);
});
        
/* Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);
}); */
Route::resource('products', ProductController::class);
Route::resource('pedidos', PedidosController::class);

//Route::get('/me', 'PedidosController@me');


/*Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', 'AuthController@me');
});*/