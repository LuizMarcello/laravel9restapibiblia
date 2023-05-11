<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VersiculoController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\VersaoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\TestamentoController;
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

Route::get('/teste', function () {
    return 'Teste com sucesso';
});

//Route::get('/testamento', [TestamentoController::class, 'index']);
//Route::get('/testamento/{id}', [TestamentoController::class, 'show']);
//Route::put('/testamento/{id}', [TestamentoController::class, 'update']);
//Route::post('/testamento', [TestamentoController::class, 'store']);
//Route::delete('/testamento/{id}', [TestamentoController::class, 'destroy']);

//Route::get('/livro', [LivroController::class, 'index']);
//Route::get('/livro/{id}', [LivroController::class, 'show']);
//Route::put('/livro/{id}', [LivroController::class, 'update']);
//Route::post('/livro', [LivroController::class, 'store']);
//Route::delete('/livro/{id}', [LivroController::class, 'destroy']);

//Route::get('/versiculo', [VersiculoController::class, 'index']);
//Route::get('/versiculo/{id}', [VersiculoController::class, 'show']);
//Route::put('/versiculo/{id}', [VersiculoController::class, 'update']);
//Route::post('/versiculo', [VersiculoController::class, 'store']);
//Route::delete('/versiculo/{id}', [VersiculoController::class, 'destroy']);

/* Usando recurso do laravel "apiResource". Todas as rotas ficarão em uma só. */
//Route::apiResource('livro', LivroController::class);
//Route::apiResource('testamento', TestamentoController::class);
//Route::apiResource('versiculo', VersiculoController::class);

/* Protegendo todas as rotas(resources): livro, testamento, versiculo,
   através deste grupo de rotas */
Route::group(['middleware' => ['auth:sanctum']], function () {
    /* Resumindo mais ainda, agora todos os "apiResources" viram uma
   rota só, usando "apiResources" do laravel.*/
    Route::apiResources([
        'livro' => LivroController::class,
        'testamento' => TestamentoController::class,
        'versiculo' => VersiculoController::class,
        'versao' => VersaoController::class,
        'idioma' => IdiomaController::class,
    ]);
    /* Rota de logout */
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
