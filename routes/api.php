<?php
Use App\Http\Controllers\{
    AuthController,
    UserController,
    TipoPagamentoController,
    MoedaController,
    TaxaController,
    ConversaoHistoricoController,
    ApiCotacaoController,
    MainController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceP rovider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login',[AuthController::class,'login']);

Route::prefix('/novo-usuario')->group(function(){
    $objController = UserController::class;
    Route::post('/', [$objController,'create']);
 
});

Route::group(['middleware' => ['apiJWT']], function(){
    Route::post('/me',[AuthController::class,'me']);

    
    Route::prefix('realizar-conversao')->group(function () {
        
        $objController = MainController::class;

        Route::post('/', [$objController, 'realizarConversao']);


    });
    Route::prefix('conversao-moeda')->group(function () {
        $objController = ApiCotacaoController::class;

        Route::get('/', [$objController, 'buscarCotacao']);


    });
    
    Route::prefix('tipo-pagamento')->group(function () {
        $objController = TipoPagamentoController::class;

        Route::get('/', [$objController, 'index']);
        Route::post('/', [$objController, 'create']);
        Route::get('/{id}', [$objController, 'show']);
        Route::put('/{id}', [$objController, 'update']);
        Route::delete('/{id}', [$objController, 'delete']);
    });

    Route::prefix('moeda')->group(function () {
        $objController = MoedaController::class;

        Route::get('/', [$objController, 'index']);
        Route::post('/', [$objController, 'create']);
        Route::get('/{id}', [$objController, 'show']);
        Route::put('/{id}', [$objController, 'update']);
        Route::delete('/{id}', [$objController, 'delete']);
    });

    Route::prefix('conversao-historico')->group(function () {
        
        $objController = ConversaoHistoricoController::class;

        Route::get('/', [$objController, 'index']);
        Route::post('/', [$objController, 'create']);
        Route::post('/usuario', [$objController, 'buscaPorUsuario']);
        Route::get('/{id}', [$objController, 'show']);
        Route::put('/{id}', [$objController, 'update']);
        Route::delete('/{id}', [$objController, 'delete']);
    });

    Route::prefix('taxa')->group(function () {
        $objController = TaxaController::class;

        Route::get('/', [$objController, 'index']);
        Route::post('/', [$objController, 'create']);
        Route::get('/{id}', [$objController, 'show']);
        Route::put('/{id}', [$objController, 'update']);
        Route::delete('/{id}', [$objController, 'delete']);
    });  

    Route::prefix('usuario')->group(function(){
        $objController = UserController::class;

        Route::get('/', [$objController,'index']);   
        Route::post('/', [$objController,'create']);
        Route::get('/{id}', [$objController,'show']);
        Route::put('/{id}', [$objController,'update']);
        Route::delete('/{id}', [$objController,'delete']);    
    });

});