<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versao extends Model
{
    use HasFactory;

    /* Confirmando que a tabela para este Model será 'versoes'. */
    protected $table = 'versoes';

    protected $fillable = ['nome', 'abreviacao', 'idioma_id'];

    /**
     * "belongsTo": Uma versão pode ter só um idioma.
     * Pegando o idioma.
     *
     * @return void
     */
    public function idioma()
    {
        return $this->belongsTo(Idioma::class);
    }

    /**
     * Uma versão pode ter vários livros
     * Pegando os livros
     *
     * @return void
     */
    public function livros()
    {
        return $this->hasMany(Livro::class);
    }
}
