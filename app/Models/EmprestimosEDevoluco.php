<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmprestimosEDevoluco extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const SITUACAO_SELECT = [
        'A devolver'          => 'A devolver',
        'Devolvido'           => 'Devolvido',
        'Prorrogado'          => 'Prorrogado',
        'Atrasado'            => 'Atrasado',
        'Devolvido com danos' => 'Devolvido com danos',
    ];

    public $table = 'emprestimos_e_devolucos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'usuario_da_biblioteca_id',
        'biblioteca_id',
        'data_de_devolucao',
        'situacao',
        'assinatura_id',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function usuario_da_biblioteca()
    {
        return $this->belongsTo(UsuariosDaBiblioteca::class, 'usuario_da_biblioteca_id');
    }

    public function biblioteca()
    {
        return $this->belongsTo(CadastrarBiblioteca::class, 'biblioteca_id');
    }

    public function livros()
    {
        return $this->belongsToMany(CadastrarLivro::class);
    }

    public function assinatura()
    {
        return $this->belongsTo(User::class, 'assinatura_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
