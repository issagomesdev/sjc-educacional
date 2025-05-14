<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotumInf extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const CHECK = [
        '0' => '✗',
        '1' => '✓',
    ];

    public $table = 'nota_inf';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bimestre',
        'ano',
        'escola_id',
        'turma_id',
        'aluno_id',
        'conhecendo_contexto',
        'registro_conquistas',
        '01EO01_s1',
        '01EO01_s2',
        '01EO02_s1',
        '01EO02_s2',
        '01EO03_s1',
        '01EO03_s2',
        '01EO04_s1',
        '01EO04_s2',
        '01EO05_s1',
        '01EO05_s2',
        '01EO06_s1',
        '01EO06_s2',
        '01EO07_s1',
        '01EO07_s2',
        '02EO01_s1',
        '02EO01_s2',
        '02EO02_s1',
        '02EO02_s2',
        '02EO03_s1',
        '02EO03_s2',
        '02EO04_s1',
        '02EO04_s2',
        '02EO05_s1',
        '02EO05_s2',
        '02EO06_s1',
        '02EO06_s2',
        '02EO07_s1',
        '02EO07_s2',
        '01ET01_s1',
        '01ET01_s2',
        '01ET02_s1',
        '01ET02_s2',
        '01ET03_s1',
        '01ET03_s2',
        '01ET04_s1',
        '01ET04_s2',
        '01ET05_s1',
        '01ET05_s2',
        '01ET06_s1',
        '01ET06_s2',
        '01ET07_s1',
        '01ET07_s2',
        '01ET08_s1',
        '01ET08_s2',
        '01ET09_s1',
        '01ET09_s2',
        '02ET01_s1',
        '02ET01_s2',
        '02ET02_s1',
        '02ET02_s2',
        '02ET03_s1',
        '02ET03_s2',
        '02ET04_s1',
        '02ET04_s2',
        '02ET05_s1',
        '02ET05_s2',
        '02ET06_s1',
        '02ET06_s2',
        '02ET07_s1',
        '02ET07_s2',
        '02ET08_s1',
        '02ET08_s2',
        'parecer_descritivo_s1',
        'parecer_descritivo_s2',
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
        return $this->belongsTo(Cadastro::class, 'alunos_id');
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
