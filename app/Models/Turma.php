<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\EscolaFiltr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turma extends Model
{
    use SoftDeletes;
    use EscolaFiltr;
    use Auditable;
    use HasFactory;

    public const SERIES = [
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

    public const TURNO_RADIO = [
        'Manhã' => 'Manhã',
        'Tarde' => 'Tarde',
        'Noite' => 'Noite',
    ];

    public const TIPO_RADIO = [
        'Regular' => 'Regular',
        'Diversificada' => 'Diversificada',
    ];

    public const NIVEL_DA_TURMA_RADIO = [
        'Ensino Infantil'  => 'Ensino Infantil',
        'Ensino Fundamental 1' => 'Ensino Fundamental 1',
        'Ensino Fundamental 2' => 'Ensino Fundamental 2',
        'EJA' => 'EJA',
    ];

    public $table = 'turmas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nivel_da_turma',
        'tipo_de_turma',
        'serie',
        'identificacao',
        'escola_id',
        'turno',
        'assinatura_id',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function anoSerieQuadroDeHorarios()
    {
        return $this->hasMany(QuadroDeHorario::class, 'ano_serie_id', 'id');
    }

    public function turmasPresencaEletivas()
    {
        return $this->hasMany(PresencaEletiva::class, 'turmas_id', 'id');
    }

    public function turmaVagas()
    {
        return $this->hasMany(Vaga::class, 'turma_id', 'id');
    }

    public function turmaV()
    {
        return $this->hasMany(Cadastro::class, 'turma_id', 'id')->where('escola_id', $this->escola_id);
    }

    public function turmaDispensas()
    {
        return $this->hasMany(Dispensa::class, 'turma_id', 'id');
    }

    public function turmaPlanejamentoBimestrals()
    {
        return $this->hasMany(PlanejamentoBimestral::class, 'turma_id', 'id');
    }

    public function turmaConteudosCurriculares()
    {
        return $this->belongsToMany(ConteudosCurriculare::class);
    }

    public function turmaCadastros()
    {
        return $this->hasMany(Cadastro::class, 'turma_id', 'id');
    }

    public function turmaMatriculas()
    {
        return $this->hasMany(Matricula::class, 'turma_id', 'id');
    }

    public function turmaNota()
    {
        return $this->hasMany(Notum::class, 'turma_id', 'id');
    }


    public function escola()
    {
        return $this->belongsTo(Team::class, 'escola_id');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoDeTurma::class, 'escola_id');
    }

    public function alunos()
    {
        return $this->belongsToMany(Cadastro::class);
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
