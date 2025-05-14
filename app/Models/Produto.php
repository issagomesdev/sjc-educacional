<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const CONSUMIVEL_SELECT = [
        'Sim' => 'Sim',
        'Não' => 'Não',
    ];

    public const SITUACAO_SELECT = [
        'Disponível'   => 'Disponível',
        'Indisponível' => 'Indisponível',
    ];

    public $table = 'produtos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titulo',
        'unidade',
        'descricao',
        'situacao',
        'consumivel',
        'estoque_minimo',
        'estoque_maximo',
        'localizacao',
        'assinatura_id',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categorias()
    {
        return $this->belongsToMany(CategoriasDeProduto::class);
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
