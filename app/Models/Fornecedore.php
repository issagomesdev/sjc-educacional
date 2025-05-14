<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedore extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const SITUACAO_SELECT = [
        'Ativo'   => 'Ativo',
        'Inativo' => 'Inativo',
    ];

    public const ESTADO_SELECT = [
        'TO' => 'Tocantins',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'SC' => 'Santa Catarina',
        'RR' => 'Roraima',
        'RO' => 'Rondônia',
        'RS' => 'Rio Grande do Sul',
        'RN' => 'Rio Grande do Norte',
        'RJ' => 'Rio de Janeiro',
        'PI' => 'Piauí',
        'PE' => 'Pernambuco',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'MG' => 'Minas Gerais',
        'MS' => 'Mato Grosso do Sul',
        'MT' => 'Mato Grosso',
        'MA' => 'Maranhão',
        'GO' => 'Goiás',
        'ES' => 'Espírito Santo',
        'DF' => 'Distrito Federal',
        'CE' => 'Ceará',
        'BA' => 'Bahia',
        'AM' => 'Amazonas',
        'AP' => 'Amapá',
        'AL' => 'Alagoas',
        'AC' => 'Acre',
    ];

    public $table = 'fornecedores';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'razao',
        'nome',
        'cep',
        'estado',
        'cidade',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'rg',
        'telefone_1',
        'telefone_2',
        'contato',
        'banco',
        'agencia',
        'conta',
        'email',
        'site',
        'observacoes',
        'situacao',
        'assinatura_id',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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
