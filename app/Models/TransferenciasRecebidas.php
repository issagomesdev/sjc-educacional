<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\EscolaFiltr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferenciasRecebidas extends Model
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

    public $table = 'transferencias_recebidas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ano',
        'tipo_de_transferencia',
        'escola_id',
        'old_turma_id',
        'old_escola_id',
        'aluno_id',
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

    public function old_escola()
    {
        return $this->belongsTo(Team::class, 'old_escola_id');
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
