<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\EscolaFiltr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transferencium extends Model
{
    use SoftDeletes;
    use EscolaFiltr;
    use Auditable;
    use HasFactory;

    public const TIPO_DE_TRANSFERENCIA = [
        '1' => 'Transferência Interna',
        '2' => 'Transferência Externa',
        '3' => 'Transferência de Turma',
    ];

    public $table = 'transferencia';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ano',
        'escola_id',
        'turma_id',
        'old_turma_id',
        'new_escola_id',
        'aluno_id',
        'tipo_de_transferencia',
        'assinatura_id',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function ano()
    {
        return $this->belongsTo(AbrirEEncerrarAnoLetivo::class, 'ano_id');
    }

    public function escola()
    {
        return $this->belongsTo(Team::class, 'escola_id');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function old_turma()
    {
        return $this->belongsTo(Turma::class, 'old_turma_id');
    }

    public function aluno()
    {
        return $this->belongsTo(Cadastro::class, 'aluno_id');
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
