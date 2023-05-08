<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testamento extends Model
{
    use HasFactory;

    /* Declarando qual vai ser a tabela deste modelo */
    /* protected $table = 'testamentos'; */

    protected $fillable = ['nome'];

    /* Para não mais inserir as datas de criação e de atualização */
    /* public $timeStamps = false; */

    /**
     * Relacionamentos
     * Pegar todos os livros vinculados.
     * testamento com livros.
     * hasMany(): (n,1) Um testamento pode ter "n" livros;
     */
    public function livros()
    {
        return $this->hasMany(Livro::class);
    }
}
