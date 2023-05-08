<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    /* Declarando qual vai ser a tabela deste modelo */
    /* protected $table = 'livros'; */

    protected $fillable = ['nome', 'posicao', 'abreviacao', 'testamento_id',];

    /* Para não mais inserir as datas de criação e de atualização */
    /* public $timeStamps = false; */

    /**
     * Pega o testamento
     * Relacionamentos
     * Livros com testamento
     * belongsTo(): (1,n) Os livros podem pertencer somente a um testamento.
     *
     * @return void
     */
    public function testamento()
    {
        return $this->belongsTo(Testamento::class);
    }

    /**
     * Pegar todos os versículos vinculados
     * Livros com versículos
     * hasMany(): (n,1) Um livro pode ter "n" versiculos;
     */
    public function versiculos()
    {
        return $this->hasMany(Versiculo::class);
    }
}
