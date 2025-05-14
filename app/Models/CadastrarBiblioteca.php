<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CadastrarBiblioteca extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

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

    public const F_A = [
        '1' => 'Aberto',
        '0'  => 'Fechado',
    ];

    public const LOCALIZACAO_RADIO = [
        'Urbana' => 'Urbana',
        'Rural'  => 'Rural',
    ];

    public $table = 'cadastrar_bibliotecas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nome_da_biblioteca',
        'localizacao',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'domingo',
        'horario_1',
        'horario_1_2',
        'segunda',
        'horario_2',
        'horario_2_2',
        'terca_feira',
        'horario_3',
        'horario_3_2',
        'quarta_feira',
        'horario_4',
        'horario_4_2',
        'quinta_feira',
        'horario_5',
        'horario_5_2',
        'sexta_feira',
        'horario_6',
        'horario_6_2',
        'sabado',
        'horario_7',
        'horario_7_2',
        'team_id',
        'assinatura_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bibliotecaCadastrarLivros()
    {
        return $this->hasMany(CadastrarLivro::class, 'biblioteca_id', 'id');
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
