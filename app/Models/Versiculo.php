<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versiculo extends Model
{
    use HasFactory;

    /* Declarando qual vai ser a tabela deste modelo */
    /* protected $table = 'testamentos'; */

    protected $fillable = ['capitulo', 'versiculo', 'texto', 'livro_id'];

    /* Para não mais inserir as datas de criação e de atualização */
    /* public $timeStamps = false; */


    /**
     * Pega o livro
     * Versiculos com livros
     * belongsTo(): (1,n) O versiculo pode pertencer somente a um livro.
     *
     * @return void
     */
    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }
}
