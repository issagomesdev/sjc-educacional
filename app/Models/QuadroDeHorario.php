<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\EscolaFiltr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuadroDeHorario extends Model
{
    use SoftDeletes;
    use EscolaFiltr;
    use Auditable;
    use HasFactory;

    public const PERIODO_RADIO = [
        'Tarde' => 'Tarde',
        'Manha' => 'Manha',
        'Noite' => 'Noite',
    ];

    public const DIAS_RADIO = [
        'Seg'  => 'Segunda-feira',
        'Ter'  => 'Terça-feira',
        'Qua'  => 'Quarta-feira',
        'Quin' => 'Quinta-feira',
        'Sex'  => 'Sexta-feira',
        'Sab'  => 'Sábado',
        'Dom'  => 'Domingo',
    ];

    public $table = 'quadro_de_horarios';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'escola_id',
        'ano_id',
        'turma_id',
        'periodo',
        'dias',
        'horario',
        'materias_id',
        'professor_id',
        'team_id',
        'assinatura_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function escola()
    {
        return $this->belongsTo(Team::class, 'escola_id');
    }

    public function ano()
    {
        return $this->belongsTo(AbrirEEncerrarAnoLetivo::class, 'ano_id');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function materias()
    {
        return $this->belongsTo(Materium::class, 'materias_id');
    }

    public function professor()
    {
        return $this->belongsTo(Profissionai::class, 'professor_id');
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
        return $date->format('H:i');
    }
}
