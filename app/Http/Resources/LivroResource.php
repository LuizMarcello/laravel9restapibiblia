<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'posicao' => $this->posicao,
            'nome' => $this->nome,
            'abreviacao' => $this->abreviacao,
            /* Um livro só tem um testamento */
            'testamento' => new TestamentoResource($this->whenLoaded('testamento')) ,
            /* Um livro pode ter vários versiculos */
            'versiculos' => new VersiculosCollection($this->whenLoaded('versiculos')),
            /* Um livro só tem uma versão */
            'versao' => new VersaoResource($this->whenLoaded('versao'))
        ];
    }
}
