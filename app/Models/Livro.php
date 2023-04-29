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
}
