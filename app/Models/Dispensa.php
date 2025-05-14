<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\EscolaFiltr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dispensa extends Model
{
    use SoftDeletes;
    use EscolaFiltr;
    use Auditable;
    use HasFactory;

    public const TIPO_DE_DISPENSA_RADIO = [
        '1' => 'Dispensa de disciplina',
        '0' => 'Dispensa de bimestre letivo',
    ];


    public const BIMESTRE_RADIO = [
        '0' => 'Não dispensado',
        '1' => 'Dispensado',
    ];

    public $table = 'dispensas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ano',
        'tipo_de_dispensa',
        'motivo',
        'escola_id',
        'turma_id',
        'bimestre_1',
        'bimestre_2',
        'bimestre_3',
        'bimestre_4',
        'team_id',
        'assinatura_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function disciplinas()
    {
        return $this->belongsToMany(Materium::class);
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
        return $this->belongsToMany(Cadastro::class);
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
