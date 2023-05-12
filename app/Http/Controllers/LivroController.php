<?php

use App\Models\Livro;

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Livro::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Livro::create($request->all())) {
            return response()->json([
                'message' => 'Livro cadastrado com sucesso.'
            ], 201);
        }
        return response()->json([
            'message' => 'Erro ao cadastrar o livro.'
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $livro
     * @return \Illuminate\Http\Response
     */
    public function show($livro)
    {
        /* Assim não pode ser "findOrFail". */
        $livro = Livro::find($livro);
        dd(Storage::disk('public')->url($livro->capa));
        if ($livro) {
            /* Um livro pertence a um só testamento */
            $livro->testamento; //Relacionamento a ser trazido nas respostas
            /* Um livro pode ter vários versiculos */
            $livro->versiculos; //Relacionamento a ser trazido nas respostas
            /* Um livro pertence a uma só versão */
            $livro->versao; //Relacionamento a ser trazido nas respostas

            return $livro;
        }

        return response()->json([
            'message' => 'Erro ao pesquisar o livro.'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $livro)
    {
        /* capturando o hash gerado */
        //dd($request->capa->hashName());
        /* Capturando o nome original do arquivo */
        //dd($request->capa->getClientOriginalName());

        /* Salvando o arquivo no disco, conforme config/filesystems.php */
        $path = $request->capa->store('capa_livro', 'public');

        $livro = Livro::find($livro);
        if ($livro) {
            /* $livro->update($request->all()); */
            $livro->capa = $path;
            if ($livro->save()) {
                return $livro;
            }
            return response()->json([
                'message' => 'Erro ao atualizar o livro.'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy($livro)
    {
        if (Livro::destroy($livro)) {
            return response()->json([
                'message' => 'Livro deletado com sucesso.'
            ], 201);
        };
        return response()->json([
            'message' => 'Erro ao deletar o livro.'
        ], 404);
    }
}
