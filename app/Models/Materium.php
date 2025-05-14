<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materium extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const INDIQUE_O_NIVEL_DE_ENSINO_RADIO = [
      'Ensino Infantil'  => 'Ensino Infantil',
      'Ensino Fundamental 1' => 'Ensino Fundamental 1',
      'Ensino Fundamental 2' => 'Ensino Fundamental 2',
      'EJA' => 'EJA',
    ];

    public $table = 'materia';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nome_da_materia',
        'nivel_de_ensino',
        'carga_horaria',
        'hora_falta',
        'assinatura_id',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function materiasQuadroDeHorarios()
    {
        return $this->hasMany(QuadroDeHorario::class, 'materias_id', 'id');
    }

    public function disciplinaPresencaEletivas()
    {
        return $this->hasMany(PresencaEletiva::class, 'disciplina_id', 'id')->where('selecione_falta', 'FNJ');
    }

    public function disciplinaConteudosCurriculares()
    {
        return $this->hasMany(ConteudosCurriculare::class, 'disciplina_id', 'id');
    }

    public function disciplinaPlanejamentoBimestrals()
    {
        return $this->hasMany(PlanejamentoBimestral::class, 'disciplina_id', 'id');
    }

    public function disciplinaNota()
    {
        return $this->hasMany(Notum::class, 'disciplina_id', 'id');
    }

    public function disciplinasDispensas()
    {
        return $this->belongsToMany(Dispensa::class);
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
