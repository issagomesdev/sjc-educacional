<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurriculoDePernambuco extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const NIVEL_DE_ENSINO_SELECT = [
        '1' => 'Ensino Infantil',
        '2' => 'Ensino Fundamental 1',
        '3' => 'Ensino Fundamental 2',
        '4' => 'EJA',
    ];

    public $table = 'curriculo_de_pernambucos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'codigo',
        'objetivo_habilidade',
        'nivel_de_ensino',
        'aprendizagem_desenvolvimento',
        'disciplina_id',
        'unidade_tematica',
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
