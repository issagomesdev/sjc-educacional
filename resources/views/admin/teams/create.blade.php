@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cadastrar Instituição
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.teams.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.team.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tipo_de_instituicao_id">Tipo de Instituição</label>
                <select class="form-control select2 {{ $errors->has('tipo_de_instituicao') ? 'is-invalid' : '' }}" name="tipo_de_instituicao_id" id="tipo_de_instituicao_id">
                    @foreach($tipo_de_instituicaos as $id => $entry)
                        <option value="{{ $id }}" {{ old('tipo_de_instituicao_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipo_de_instituicao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo_de_instituicao') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="owner_id">{{ trans('cruds.team.fields.owner') }}</label>
                <select class="form-control select2 {{ $errors->has('owner') ? 'is-invalid' : '' }}" name="owner_id" id="owner_id">
                    @foreach($owners as $id => $entry)
                        <option value="{{ $id }}" {{ old('owner_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('owner'))
                    <div class="invalid-feedback">
                        {{ $errors->first('owner') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.owner_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.team.fields.localizacao') }}</label>
                @foreach(App\Models\Team::LOCALIZACAO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('localizacao') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="localizacao_{{ $key }}" name="localizacao" value="{{ $key }}" {{ old('localizacao', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="localizacao_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('localizacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('localizacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.localizacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.team.fields.estado') }}</label>
                <select class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado" id="estado">
                    <option value disabled {{ old('estado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Team::ESTADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estado', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.estado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cidade">{{ trans('cruds.team.fields.cidade') }}</label>
                <input class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" type="text" name="cidade" id="cidade" value="{{ old('cidade', '') }}">
                @if($errors->has('cidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.cidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bairro">{{ trans('cruds.team.fields.bairro') }}</label>
                <input class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" type="text" name="bairro" id="bairro" value="{{ old('bairro', '') }}">
                @if($errors->has('bairro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bairro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.bairro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endereco">{{ trans('cruds.team.fields.endereco') }}</label>
                <input class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" type="text" name="endereco" id="endereco" value="{{ old('endereco', '') }}">
                @if($errors->has('endereco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('endereco') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.endereco_helper') }}</span>
            </div>
            <div class="form-group">
             <label for="cnpj"> CNPJ </label>
             <input class="form-control {{ $errors->has('cnpj') ? 'is-invalid' : '' }}" type="text" name="cnpj" id="cnpj" value="{{ old('cnpj', '') }}">
             @if($errors->has('cnpj'))
                 <div class="invalid-feedback">
                     {{ $errors->first('cnpj') }}
                 </div>
             @endif
             <span class="help-block">{{ trans('cruds.team.fields.cnpj_helper') }}</span>
         </div>
         <div class="form-group">
             <label for="telefone_de_contato">{{ trans('cruds.team.fields.telefone_de_contato') }}</label>
             <input class="form-control {{ $errors->has('telefone_de_contato') ? 'is-invalid' : '' }}" type="text" name="telefone_de_contato" id="telefone_de_contato" value="{{ old('telefone_de_contato', '') }}">
             @if($errors->has('telefone_de_contato'))
                 <div class="invalid-feedback">
                     {{ $errors->first('telefone_de_contato') }}
                 </div>
             @endif
             <span class="help-block">{{ trans('cruds.team.fields.telefone_de_contato_helper') }}</span>
         </div>
         <div class="form-group">
             <label for="telefone_de_contato_2">{{ trans('cruds.team.fields.telefone_de_contato_2') }}</label>
             <input class="form-control {{ $errors->has('telefone_de_contato_2') ? 'is-invalid' : '' }}" type="text" name="telefone_de_contato_2" id="telefone_de_contato_2" value="{{ old('telefone_de_contato_2', '') }}">
             @if($errors->has('telefone_de_contato_2'))
                 <div class="invalid-feedback">
                     {{ $errors->first('telefone_de_contato_2') }}
                 </div>
             @endif
             <span class="help-block">{{ trans('cruds.team.fields.telefone_de_contato_2_helper') }}</span>
         </div>
         <div class="form-group">
             <label for="telefone_de_contato_3">{{ trans('cruds.team.fields.telefone_de_contato_3') }}</label>
             <input class="form-control {{ $errors->has('telefone_de_contato_3') ? 'is-invalid' : '' }}" type="text" name="telefone_de_contato_3" id="telefone_de_contato_3" value="{{ old('telefone_de_contato_3', '') }}">
             @if($errors->has('telefone_de_contato_3'))
                 <div class="invalid-feedback">
                     {{ $errors->first('telefone_de_contato_3') }}
                 </div>
             @endif
             <span class="help-block">{{ trans('cruds.team.fields.telefone_de_contato_3_helper') }}</span>
         </div>
         <div class="form-group">
             <label for="email_de_contato">{{ trans('cruds.team.fields.email_de_contato') }}</label>
             <input class="form-control {{ $errors->has('email_de_contato') ? 'is-invalid' : '' }}" type="text" name="email_de_contato" id="email_de_contato" value="{{ old('email_de_contato', '') }}">
             @if($errors->has('email_de_contato'))
                 <div class="invalid-feedback">
                     {{ $errors->first('email_de_contato') }}
                 </div>
             @endif
             <span class="help-block">{{ trans('cruds.team.fields.email_de_contato_helper') }}</span>
         </div>
         <div class="form-group">
             <label>{{ trans('cruds.team.fields.dependencia_administrativa') }}</label>
             <select class="form-control {{ $errors->has('dependencia_administrativa') ? 'is-invalid' : '' }}" name="dependencia_administrativa" id="dependencia_administrativa">
                 <option value disabled {{ old('dependencia_administrativa', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                 @foreach(App\Models\Team::DEPENDENCIA_ADMINISTRATIVA_SELECT as $key => $label)
                     <option value="{{ $key }}" {{ old('dependencia_administrativa', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                 @endforeach
             </select>
             @if($errors->has('dependencia_administrativa'))
                 <div class="invalid-feedback">
                     {{ $errors->first('dependencia_administrativa') }}
                 </div>
             @endif
             <span class="help-block">{{ trans('cruds.team.fields.dependencia_administrativa_helper') }}</span>
         </div>
         <div class="form-group">
             <label>{{ trans('cruds.team.fields.situacao') }}</label>
             <select class="form-control {{ $errors->has('situacao') ? 'is-invalid' : '' }}" name="situacao" id="situacao">
                 <option value disabled {{ old('situacao', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                 @foreach(App\Models\Team::SITUACAO_SELECT as $key => $label)
                     <option value="{{ $key }}" {{ old('situacao', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                 @endforeach
             </select>
             @if($errors->has('situacao'))
                 <div class="invalid-feedback">
                     {{ $errors->first('situacao') }}
                 </div>
             @endif
             <span class="help-block">{{ trans('cruds.team.fields.situacao_helper') }}</span>
         </div>
            <input type="hidden" class="assinatura_id" value="{{Auth::user()->id}}" for="assinatura_id" name="assinatura_id">
            <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
