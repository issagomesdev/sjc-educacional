<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CadastrarMotoristum extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
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

    public const GENERO_RADIO = [
        'Feminino'  => 'Feminino',
        'Masculino' => 'Masculino',
    ];

    public const SITUACAO_DE_CONTRATACAO_SELECT = [
        'Ativo'      => 'Ativo',
        'Desligado'  => 'Desligado',
        'Temporário' => 'Temporário',
    ];

    public $table = 'cadastrar_motorista';

    protected $dates = [
        'data_de_nascimento',
        'data_da_habilitacao',
        'vencimento_da_habilitacao',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nome_completo',
        'genero',
        'data_de_nascimento',
        'data_da_habilitacao',
        'vencimento_da_habilitacao',
        'codigo_do_motorista',
        'cnh',
        'cpf',
        'rg',
        'observacoes',
        'localizacao',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'ano_de_contratacao',
        'situacao_de_contratacao',
        'numero_de_telefone',
        'instituicao_id',
        'team_id',
        'assinatura_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function motoristaResponsavelCadastrarveiculos()
    {
        return $this->belongsToMany(Cadastrarveiculo::class);
    }

    public function getDataDeNascimentoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataDeNascimentoAttribute($value)
    {
        $this->attributes['data_de_nascimento'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDataDaHabilitacaoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataDaHabilitacaoAttribute($value)
    {
        $this->attributes['data_da_habilitacao'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getVencimentoDaHabilitacaoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setVencimentoDaHabilitacaoAttribute($value)
    {
        $this->attributes['vencimento_da_habilitacao'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function instituicao()
    {
        return $this->belongsTo(Team::class, 'instituicao_id');
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
