<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bncc extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const NIVEL_DE_ENSINO_SELECT = [
        'Ensino Infantil' => 'Ensino Infantil',
        'Ensino Fundamental 1' => 'Ensino Fundamental 1',
        'Ensino Fundamental 2' => 'Ensino Fundamental 2',
        'EJA' => 'EJA',
    ];

    public $table = 'bnccs';

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
