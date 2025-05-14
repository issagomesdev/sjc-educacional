<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\EscolaFiltr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Cadastro extends Model implements HasMedia
{
    use SoftDeletes;
    use EscolaFiltr;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const TURMA = [
      'Creche I' => 'Creche I',
      'Creche II' => 'Creche II',
      'Pré-escolar' => 'Pré-escolar',
      '1º ano' => '1º ano',
      '2º ano' => '2º ano',
      '3º ano' => '3º ano',
      '4º ano' => '4º ano',
      '5º ano' => '5º ano',
      '6º ano' => '6º ano',
      '7º ano' => '7º ano',
      '8º ano' => '8º ano',
      '9º ano' => '9º ano',
      '1º ano (EJA)' => '1º ano (EJA)',
      '2º ano (EJA)' => '2º ano (EJA)',
      '3º ano (EJA)' => '3º ano (EJA)',
    ];

    public const ALGUMA_ALERGIA_RADIO = [
        'Sim' => 'Sim',
        'Não' => 'Não',
    ];

    public const SITUACAO_ALUNO = [
        'Matriculado' => 'Matriculado',
        'Enturmado' => 'Enturmado',
        'Transferido' => 'Transferido',
    ];

    public const PROBLEMA_DE_SAUDE_RADIO = [
        'Sim' => 'Sim',
        'Não' => 'Não',
    ];

    public const ALGUM_MEDICAMENTO_RADIO = [
        'Sim' => 'Sim',
        'Não' => 'Não',
    ];

    public const ALGUMA_DEFICIENCIA_RADIO = [
        'Sim' => 'Sim',
        'Não' => 'Não',
    ];

    public const PROGRAMA_MAISEDUCA_RADIO = [
        'Sim' => 'Sim',
        'Não' => 'Não',
    ];

    public const LOCALIZACAO_RADIO = [
        'Urbana' => 'Urbana',
        'Rural'  => 'Rural',
    ];

    public const GENERO_RADIO = [
        'Feminino'  => 'Feminino',
        'Masculino' => 'Masculino',
    ];

    public const COR_RACA_SELECT = [
        'branca'           => 'branca',
        'preta'            => 'preta',
        'parda'            => 'parda',
        'amarela'          => 'amarela',
        'indígena'         => 'indígena',
        'não identificado' => 'não identificado',
    ];

    public const VAI_A_ESCOLA_SELECT = [
        'A pé'                  => 'A pé',
        'De Transporte Publico' => 'De Transporte Publico',
        'De Bicicleta'          => 'De Bicicleta',
        'De Transporte Escolar' => 'De Transporte Escolar',
        'De Carro'              => 'Outros',
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

    public $table = 'cadastros';

    protected $appends = [
        'foto_do_aluno',
        'arquivos_relacionados',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nome_completo',
        'codigo_de_cadastro',
        'codigo_do_inep',
        'ano',
        'data_de_nascimento',
        'ano_de_nascimento',
        'genero',
        'nacionalidade',
        'localizacao',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'email_do_aluno_id',
        'e_mail_de_contato',
        'certidao_de_nascimento',
        'numero_do_nis',
        'numero_do_cpf',
        'numero_da_identidade',
        'numero_de_telefone',
        'ocupacao_do_aluno',
        'nome_responsavel',
        'profissao_do_responsavel',
        'contato_de_emergencia',
        'nome_do_responsavel_2',
        'profissao_do_responsavel_2',
        'contato_de_emergencia_2',
        'email_do_responsavel_id',
        'cor_raca',
        'tipo_sanguineo',
        'problema_de_saude',
        'sesim_qual',
        'algum_medicamento',
        'sesim_qual_2',
        'alguma_deficiencia',
        'sesim_qual_3',
        'alguma_alergia',
        'sesim_qual_4',
        'vai_a_escola',
        'rota_percorrida_id',
        'situacao',
        'programa_maiseduca',
        'escola_id',
        'turma_id',
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

    public function alunosPresencaEletivas()
    {
        return $this->hasMany(PresencaEletiva::class, 'alunos_id', 'id');
    }

    public function alunoMatriculas()
    {
        return $this->hasMany(Matricula::class, 'aluno_id', 'id');
    }

    public function alunosNota()
    {
        return $this->hasMany(Notum::class, 'aluno_id', 'id');
    }

    public function faltas()
    {
        return $this->hasMany(PresencaEletiva::class, 'alunos_id', 'id')->where('selecione_falta', 'FNJ');
    }

    public function alunosTurmas()
    {
        return $this->belongsToMany(Turma::class);
    }

    public function alunosDispensas()
    {
        return $this->belongsToMany(Dispensa::class);
    }

    public function getFotoDoAlunoAttribute()
    {
        $file = $this->getMedia('foto_do_aluno')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function email_do_aluno()
    {
        return $this->belongsTo(User::class, 'email_do_aluno_id');
    }

    public function email_do_responsavel()
    {
        return $this->belongsTo(User::class, 'email_do_responsavel_id');
    }

    public function rota_percorrida()
    {
        return $this->belongsTo(Rotum::class, 'rota_percorrida_id');
    }

    public function escola()
    {
        return $this->belongsTo(Team::class, 'escola_id');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function ano()
    {
        return $this->belongsTo(AbrirEEncerrarAnoLetivo::class, 'ano_id');
    }

    public function getArquivosRelacionadosAttribute()
    {
        return $this->getMedia('arquivos_relacionados');
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
