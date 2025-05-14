<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\InstituicaoFiltr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Semaula extends Model implements HasMedia
{
    use SoftDeletes;
    use InstituicaoFiltr;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const MOTIVO_SELECT = [
        'Feriado'    => 'Feriado',
        'Ferias'     => 'Férias',
        'Reunião'    => 'Reunião',
        'Manutenção' => 'Manutenção',
        'Greve'      => 'Greve',
        'Outro'      => 'Outro',
    ];

    public $table = 'semaulas';

    protected $dates = [
        'de',
        'ate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titulo',
        'de',
        'ate',
        'motivo',
        'descricao',
        'instituicao_id',
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

    public function getDeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDeAttribute($value)
    {
        $this->attributes['de'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getAteAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setAteAttribute($value)
    {
        $this->attributes['ate'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function instituicao()
    {
        return $this->belongsTo(Team::class, 'instituicao_id');
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
