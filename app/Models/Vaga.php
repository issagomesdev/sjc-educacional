<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\EscolaFiltr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaga extends Model
{
    use SoftDeletes;
    use EscolaFiltr;
    use Auditable;
    use HasFactory;

    public $table = 'vagas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'escola_id',
        'turma_id',
        'ano',
        'total_de_vadas',
        'vagas_preenchidas',
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

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function vagas()
    {
        return $this->hasMany(Cadastro::class, 'turma_id', 'turma_id')->where('escola_id', $this->escola_id);
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
