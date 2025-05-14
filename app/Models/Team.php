<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;
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

    public const LOCALIZACAO_RADIO = [
        'Urbana' => 'Urbana',
        'Rural'  => 'Rural',
    ];

    public const SITUACAO_SELECT = [
        'Em Atividade' => 'Em Atividade',
        'Paralisada'   => 'Paralisada',
        'Extinta'      => 'Extinta',
    ];

    public const DEPENDENCIA_ADMINISTRATIVA_SELECT = [
        'Federal'   => 'Federal',
        'Municipal' => 'Municipal',
        'Estadual'  => 'Estadual',
        'Privada'   => 'Privada',
    ];

    public $table = 'teams';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'name',
        'tipo_de_instituicao_id',
        'owner_id',
        'localizacao',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'cnpj',
        'telefone_de_contato',
        'telefone_de_contato_2',
        'telefone_de_contato_3',
        'email_de_contato',
        'dependencia_administrativa',
        'situacao',
        'assinatura_id',
        'team_id',
        'deleted_at',
    ];

    public function teamCadastros()
    {
        return $this->hasMany(Cadastro::class, 'team_id', 'id');
    }

    public function escolaTurmas()
    {
        return $this->hasMany(Turma::class, 'escola_id', 'id');
    }

    public function teamPresencaEletivas()
    {
        return $this->hasMany(PresencaEletiva::class, 'team_id', 'id');
    }

    public function escolaPresencaEletivas()
    {
        return $this->hasMany(PresencaEletiva::class, 'escola_id', 'id');
    }

    public function escolaTransferencia()
    {
        return $this->hasMany(Transferencium::class, 'escola_id', 'id');
    }

    public function escolaMatriculas()
    {
        return $this->hasMany(Matricula::class, 'escola_id', 'id');
    }

    public function instituicaoInstalars()
    {
        return $this->hasMany(Instalar::class, 'instituicao_id', 'id');
    }

    public function escolaRematriculas()
    {
        return $this->hasMany(Rematricula::class, 'escola_id', 'id');
    }

    public function escolaNota()
    {
        return $this->hasMany(Notum::class, 'escola_id', 'id');
    }

    public function instituicaoProfissionais()
    {
        return $this->hasMany(Profissionai::class, 'instituicao_id', 'id');
    }

    public function escolasSemaulas()
    {
        return $this->belongsToMany(Semaula::class);
    }

    public function tipo_de_instituicao()
    {
        return $this->belongsTo(TeamType::class, 'tipo_de_instituicao_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
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
