<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BancoDeAula extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const PUBLICO_ALVO_SELECT = [
        'Ensino Infantil'      => 'Ensino Infantil',
        'Ensino Fundamental 1' => 'Ensino Fundamental 1',
        'Ensino Fundamental 2' => 'Ensino Fundamental 2',
        'EJA'                  => 'EJA',
    ];

    public const SITUACAO_DO_PROJETO_SELECT = [
        '0' => 'Pendente',
        '1' => 'Aprovado',
        '2' => 'Publicado',
        '4' => 'Em revisão',
        '5' => 'Incompleto',
        '6' => 'Em avaliação',
        '7' => 'Mudança Sugerida',
        '8' => 'Arquivo morto',
    ];

    public $table = 'banco_de_aulas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titulo',
        'resumo',
        'autor',
        'publico_alvo',
        'objetivo',
        'metodologia',
        'finalidade',
        'aceito',
        'situacao_do_projeto',
        'sugestao',
        'team_id',
        'assinatura_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function area_de_conhecimentos()
    {
        return $this->belongsToMany(Materium::class);
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
