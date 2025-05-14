<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CadastrarLivro extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const SELECIONE_RADIO = [
        'Disponível'   => 'Disponível',
        'Indisponível' => 'Indisponível',
    ];

    public const GENERO_SELECT = [
        'ficção literária'  => 'ficção literária',
        'não-ficção'        => 'não-ficção',
        'suspense'          => 'suspense',
        'ficção científica' => 'ficção científica',
        'fantasia'          => 'fantasia',
        'terror'            => 'terror',
        'poesia'            => 'poesia',
        'romance'           => 'romance',
    ];

    public $table = 'cadastrar_livros';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titulo',
        'autor',
        'idioma',
        'biblioteca_id',
        'ano',
        'editora',
        'genero',
        'assunto',
        'exemplares_existentes',
        'isbn',
        'cdd',
        'selecione',
        'team_id',
        'assinatura_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function biblioteca()
    {
        return $this->belongsTo(CadastrarBiblioteca::class, 'biblioteca_id');
    }

    public function materias_relacionadas()
    {
        return $this->belongsToMany(Materium::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function assinatura()
    {
        return $this->belongsTo(User::class, 'assinatura_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
