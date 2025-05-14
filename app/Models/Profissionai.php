<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\InstituicaoFiltr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Profissionai extends Model implements HasMedia
{
    use SoftDeletes;
    use InstituicaoFiltr;
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

    public const GENERO_RADIO = [
        'F' => 'Feminino',
        'M' => 'Masculino',
    ];

    public const LOCALIZACAO_RADIO = [
        'Urbana' => 'Urbana',
        'Rural'  => 'Rural',
    ];

    public const SITUACAO_DE_CONTRATACAO_SELECT = [
        'Ativo'      => 'Ativo',
        'Desligado'  => 'Desligado',
        'Temporário' => 'Temporário',
    ];

    public const POS_CONCLUIDAS_SELECT = [
        'Especialização' => 'Especialização',
        'Mestrado'       => 'Mestrado',
        'Doutorado'      => 'Doutorado',
    ];

    public const ENSINO_MEDIO_CURSADO_SELECT = [
        'Modalidade Normal'   => 'Modalidade Normal',
        'Formação Geral'      => 'Formação Geral',
        'Curso Tecnico'       => 'Curso Tecnico',
        'Magistério indígena' => 'Magistério indígena',
    ];

    public const ESTADO_CIVIL_SELECT = [
        'solteiro'    => 'Solteiro(a)',
        'casado'      => 'Casado(a)',
        'divorciado'  => 'Divorciado(a)',
        'viuvo'       => 'Viúvo(a)',
        'companheiro' => 'Companheiro(a)',
        'Separado'    => 'Separado(a)',
    ];

    public const ESCOLARIDADE_SELECT = [
        'Fundamental Incompleto'  => 'Fundamental Incompleto',
        'Fundamental Completo'    => 'Fundamental Completo',
        'Ensino Médio Incompleto' => 'Ensino Médio Incompleto',
        'Ensino Médio Completo'   => 'Ensino Médio Completo',
        'Superior Incompleto'     => 'Superior Incompleto',
        'Superior Completo'       => 'Superior Completo',
    ];

    public $table = 'profissionais';

    protected $appends = [
        'arquivos_relacionados',
    ];

    protected $dates = [
        'data_de_nascimento',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nome_completo',
        'data_de_nascimento',
        'genero',
        'nome_do_pai',
        'nome_da_mae',
        'estado_civil',
        'cpf',
        'rg',
        'localizacao',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'ano_de_contratacao',
        'situacao_de_contratacao',
        'escolaridade',
        'ensino_medio_cursado',
        'pos_concluidas',
        'numero_de_contato',
        'e_mail_de_usuario_id',
        'e_mail_de_contato',
        'type_id',
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

    public function professorQuadroDeHorarios()
    {
        return $this->hasMany(QuadroDeHorario::class, 'professor_id', 'id');
    }

    public function getDataDeNascimentoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataDeNascimentoAttribute($value)
    {
        $this->attributes['data_de_nascimento'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function e_mail_de_usuario()
    {
        return $this->belongsTo(User::class, 'e_mail_de_usuario_id');
    }

    public function instituicao()
    {
        return $this->belongsTo(Team::class, 'instituicao_id');
    }

    public function getArquivosRelacionadosAttribute()
    {
        return $this->getMedia('arquivos_relacionados');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function funcaos()
    {
        return $this->belongsToMany(TipoDeProfissional::class);
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
