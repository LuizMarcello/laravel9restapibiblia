<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VersaoResource extends JsonResource
{

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    //public static $wrap = 'idioma';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     *
     * Método "toArray()" para retornar a aplicação.
     * Propriedade "collection" para retornar as informações
     * da coleção.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'abreviacao' => $this->abreviacao,
            /* "IdiomaResource": Uma versão pode ter só um idioma */
            /* "LivrosCollection": Uma versão pode ter vários livros */
            'idioma' => new IdiomaResource($this->whenLoaded('idioma')),
            'livros' => new LivrosCollection($this->whenLoaded('Livros'))
        ];
    }
}
