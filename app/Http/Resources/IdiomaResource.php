<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IdiomaResource extends JsonResource
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
            /* Uma versão só tem um idioma */
            /* "VersoesCollection": Um idioma pode ter várias versões */
            'versoes' => new VersoesCollection($this->whenLoaded('versoes'))
        ];
    }
}
