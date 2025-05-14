<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cadastrarveiculo extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const SITUACAO_SELECT = [
        'Ativo'   => 'Ativo',
        'Inativo' => 'Inativo',
    ];

    public $table = 'cadastrarveiculos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'niv',
        'placa',
        'renavam',
        'marca',
        'descricao',
        'instituicao_id',
        'situacao',
        'team_id',
        'assinatura_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function veiculoResponsavelRota()
    {
        return $this->hasMany(Rotum::class, 'veiculo_responsavel_id', 'id');
    }

    public function instituicao()
    {
        return $this->belongsTo(Team::class, 'instituicao_id');
    }

    public function motorista_responsavels()
    {
        return $this->belongsToMany(CadastrarMotoristum::class);
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
