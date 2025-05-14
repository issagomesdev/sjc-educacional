<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notum extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const BIMESTRE_SELECT = [
        '1B' => '1° Bimestre',
        '2B' => '2° Bimestre',
        '3B' => '3° Bimestre',
        '4B' => '4° Bimestre',
        'MA' => 'Media Anual',
        'RF' => 'Resultado Final',
    ];

    public $table = 'nota';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [

        'aluno_id',
        'ano',
        'escola_id',
        'turma_id',
        'bimestre',
        'disciplina_id',
        'at1',
        'at2',
        'at3',
        'at4',
        'at5',
        'nota1',
        'nota2',
        'mb',
        'rec',
        'mrecf',
        'team_id',
        'assinatura_id',
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
