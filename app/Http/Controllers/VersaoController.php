<?php

namespace App\Http\Controllers;

use App\Models\Versao;
use Illuminate\Http\Request;
use App\Http\Resources\VersaoResource;
use App\Http\Resources\VersoesCollection;

class VersaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* get: Obtem tudo */
        //return Versao::all();
        return new VersoesCollection(Versao::select('id', 'nome', 'abreviacao')
            //->get());
            ->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* post: "Formulário("o quê") vai ser armazenado */
        if (Versao::create($request->all())) {
            return response()->json([
                'message' => 'Versao cadastrado com sucesso.'
            ], 201);
        }

        return response()->json([
            'message' => 'Erro ao cadastrar a versão'
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($versao)
    {
        /* get: "Quem" vai ser mostrado("id") */
        /* Uma versão pode ter só um idioma */
        /* Uma versão pode ter vários livros */
        $versao = Versao::with('idioma', 'livros')->find($versao);
        if ($versao) {
            return new VersaoResource($versao);
        }

        return response()->json([
            'message' => 'Erro ao pesquisar a versão.'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $versao)
    {
        /* put: Formulário("O quê" vai ser atualizado), e "Quem"("id")
           vai ser atualizado */
        $versao = Versao::findOrFail($versao);
        if ($versao) {
            $versao->update($request->all());

            return $versao;
        }

          return response()->json([
            'message' => 'Erro ao atualizar a versão.'
           ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($versao)
    {
        /* delete: "Quem"("id") vai ser deletado */
        if (Versao::destroy($versao)) {
            return response()->json([
                'message' => 'Versao deletada com sucesso.'
            ], 201);
        };
        return response()->json([
            'message' => 'Erro ao deletar a versão.'
        ], 404);
    }
}
