<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait InstituicaoFiltr
{
    public static function bootInstituicaoFiltr()
    {

      // Admin code.

      if (!app()->runningInConsole() && auth()->check()) {
          $isAdmin = auth()->user()->tipo_de_acessos->contains(2);
          static::creating(function ($model) use ($isAdmin) {
              // Prevent admin from setting his own id - admin entries are global.
              // If required, remove the surrounding IF condition and admins will act as users
              if (!$isAdmin) {
                  $model->instituicao_id = auth()->user()->team_id;
              }
          });

          if (!$isAdmin) {
              static::addGlobalScope('team_id' , function (Builder $builder) {
                  $field = sprintf('%s.%s', $builder->getQuery()->from, 'instituicao_id');

                  $builder->where($field, auth()->user()->team_id)->orWhereNull($field);
              });
          }
      }
    }

}
