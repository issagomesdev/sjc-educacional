<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresencaEletiva extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const SELECIONE_FALTA_RADIO = [
        'P' =>  'Presente',
        'FJ'  => 'Falta Justificada',
        'FNJ' => 'Falta Não Justificada',
    ];

    public const BIMESTRE_SELECT = [
        '1B' => '1° Bimestre',
        '2B' => '2° Bimestre',
        '3B' => '3° Bimestre',
        '4B' => '4° Bimestre',
    ];

    public const SELECIONAR_MOTIVO_SELECT = [

        'AM'   => 'AM',
        'DC'   => 'DC',
        'DP'   => 'DP',
        'EA'   => 'EA',
        'EG'   => 'EG',
        'ET'   => 'ET',
        'FTE'  => 'FTE',
        'OCO'  => 'OCO',
        'PAND' => 'PAND',
    ];

    public $table = 'presenca_eletivas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'data',
        'ano',
        'disciplina_id',
        'bimestre',
        'escola_id',
        'turmas_id',
        'alunos_id',
        'selecione_falta',
        'selecionar_motivo',
        'team_id',
        'assinatura_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function ano()
    {
        return $this->belongsTo(AbrirEEncerrarAnoLetivo::class, 'ano_id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Materium::class, 'disciplina_id');
    }

    public function escola()
    {
        return $this->belongsTo(Team::class, 'escola_id');
    }

    public function turmas()
    {
        return $this->belongsTo(Turma::class, 'turmas_id');
    }

    public function alunos()
    {
        return $this->belongsTo(Cadastro::class, 'alunos_id');
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
