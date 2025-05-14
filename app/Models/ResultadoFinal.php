<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResultadoFinal extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'resultado_final';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ano',
        'escola_id',
        'turma_id',
        'disciplina_id',
        'aluno_id',
        'nota_final',
        'presence',
        'tipo_de_aprovacao',
        'resultado_final',
        'detalhes',
        'assinatura_id',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function disciplina()
    {
        return $this->belongsTo(Materium::class, 'disciplina_id');
    }

    public function escola()
    {
        return $this->belongsTo(Team::class, 'escola_id');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function alunos()
    {
        return $this->belongsTo(Cadastro::class, 'aluno_id');
    }

    public function faltas()
    {
        return $this->hasMany(PresencaEletiva::class, 'alunos_id')->where('selecione_falta', 2);
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
