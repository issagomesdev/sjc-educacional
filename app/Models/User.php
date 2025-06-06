<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes;
    use Notifiable;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const SITUACAO_SELECT = [
        'Ativo'                     => 'Ativo',
        'Bloqueado'                 => 'Bloqueado',
        'Bloqueado temporariamente' => 'Bloqueado temporariamente',
    ];

    public $table = 'users';

    protected $appends = [
        'foto_de_perfil',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'situacao',
        'team_id',
        'assinatura_id',
        'assinatura_team_id',
        'profissional_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function emailDoAlunoCadastros()
    {
        return $this->hasMany(Cadastro::class, 'email_do_aluno_id', 'id');
    }

    public function assinaturaCadastrarBibliotecas()
    {
        return $this->hasMany(CadastrarBiblioteca::class, 'assinatura_id', 'id');
    }

    public function assinaturaDocumentos()
    {
        return $this->hasMany(Documento::class, 'assinatura_id', 'id');
    }

    public function eMailDeUsuarioProfissionais()
    {
        return $this->hasMany(Profissionai::class, 'e_mail_de_usuario_id', 'id');
    }

    public function assinaturaPermissions()
    {
        return $this->hasMany(Permission::class, 'assinatura_id', 'id');
    }
    
    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function getFotoDePerfilAttribute()
    {
        $file = $this->getMedia('foto_de_perfil')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function tipo_de_acessos()
    {
        return $this->belongsToMany(Type::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function assinatura()
    {
        return $this->belongsTo(User::class, 'assinatura_id');
    }

    public function assinatura_team()
    {
        return $this->belongsTo(Team::class, 'assinatura_team_id');
    }

    public function profissional()
    {
        return $this->belongsTo(Profissionai::class, 'profissional_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
