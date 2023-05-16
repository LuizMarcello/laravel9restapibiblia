<?php

namespace App\Http\Controllers;

use App\Http\Resources\IdiomaResource;
use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* get: Obtem tudo */
        return Idioma::all();
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
        if (Idioma::create($request->all())) {
            return response()->json([
                'message' => 'Idioma cadastrado com sucesso.'
            ], 201);
        }

        return response()->json([
            'message' => 'Erro ao cadastrar o idioma'
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idioma)
    {
        /* get: "Quem" vai ser mostrado("id") */
        $idioma = Idioma::with('versoes')->find($idioma);
        if ($idioma) {
            /* Um idioma pode ter várias versões] */
            //$idioma->versoes;
            //return $idioma;
            return new IdiomaResource($idioma);
        }

        return response()->json([
            'message' => 'Erro ao pesquisar o idioma'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idioma)
    {
        /* put: Formulário("O quê" vai ser atualizado), e
           "Quem"("id") vai ser atualizado */
           $idioma = Idioma::findOrFail($idioma);
           
          if ($idioma) {
            $idioma->update($request->all());

            return $idioma;
        }

             return response()->json([
            'message' => 'Erro ao atualizar o idioma'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idioma)
    {
        /* delete: "Quem"("id") vai ser deletado */
        if (Idioma::destroy($idioma)) {
            return response()->json([
                'message' => 'Idioma deletado com sucesso.'
            ], 201);
        };
        return response()->json([
            'message' => 'Erro ao deletar o idioma.'
        ], 404);
    }
}
