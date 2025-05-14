@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Adicionar Currículo de Pernambuco
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.curriculo-de-pernambucos.store") }}" enctype="multipart/form-data">
            @csrf
            @csrf
            <div class="form-group">
                <label for="codigo">Código</label>
                <input class="form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" type="text" name="codigo" id="codigo" value="{{ old('codigo', '') }}" required>
                @if($errors->has('codigo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('codigo') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label> Nível De Ensino	</label>
                <select class="form-control {{ $errors->has('nivel_de_ensino') ? 'is-invalid' : '' }}" name="nivel_de_ensino" id="nivel_de_ensino" required>
                    <option value disabled {{ old('nivel_de_ensino', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Bncc::NIVEL_DE_ENSINO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('nivel_de_ensino', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('nivel_de_ensino'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivel_de_ensino') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="series">Séries</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2" name="series[]" id="series" multiple required>
                  <option value="Creche 1" {{ in_array('Creche 1', old('series', [])) ? 'selected' : '' }}> Creche - 0 a 1 ano e 6 meses </option>
                  <option value="Creche 2" {{ in_array('Creche 2', old('series', [])) ? 'selected' : '' }}> Creche - 1 ano e 7 meses a 3 anos e 11 meses </option>
                  <option value="Pré-escolar" {{ in_array('Pré-escolar', old('series', [])) ? 'selected' : '' }}> Pré-escolar - 4 a 5 anos </option>
                  <option value="1º ano" {{ in_array('1º ano', old('series', [])) ? 'selected' : '' }}> 1º ano - Fundamental I </option>
                  <option value="2º ano" {{ in_array('2º ano', old('series', [])) ? 'selected' : '' }}> 2º ano - Fundamental I </option>
                  <option value="3º ano" {{ in_array('3º ano', old('series', [])) ? 'selected' : '' }}> 3º ano - Fundamental I </option>
                  <option value="4º ano" {{ in_array('4º ano', old('series', [])) ? 'selected' : '' }}> 4º ano - Fundamental I </option>
                  <option value="5º ano" {{ in_array('5º ano', old('series', [])) ? 'selected' : '' }}> 5º ano - Fundamental I </option>
                  <option value="6º ano" {{ in_array('6º ano', old('series', [])) ? 'selected' : '' }}> 6º ano - Fundamental II </option>
                  <option value="7º ano" {{ in_array('7º ano', old('series', [])) ? 'selected' : '' }}> 7º ano - Fundamental II </option>
                  <option value="8º ano" {{ in_array('8º ano', old('series', [])) ? 'selected' : '' }}> 8º ano - Fundamental II </option>
                  <option value="9º ano" {{ in_array('9º ano', old('series', [])) ? 'selected' : '' }}> 9º ano - Fundamental II </option>
                  <option value="1º ano(EJA)" {{ in_array('1º ano(EJA)', old('series', [])) ? 'selected' : '' }}> 1º ano - EJA </option>
                  <option value="2º ano(EJA)" {{ in_array('2º ano(EJA)', old('series', [])) ? 'selected' : '' }}> 2º ano - EJA </option>
                  <option value="3º ano(EJA)" {{ in_array('3º ano(EJA)', old('series', [])) ? 'selected' : '' }}> 3º ano - EJA </option>
                </select>
                @if($errors->has('series'))
                    <div class="invalid-feedback">
                        {{ $errors->first('series') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="disciplina_id"> Disciplina </label>
                <select class="form-control select2 {{ $errors->has('disciplina') ? 'is-invalid' : '' }}" name="disciplina_id" id="disciplina_id" required>
                    @foreach($disciplinas as $id => $entry)
                        <option value="{{ $id }}" {{ old('disciplina_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('disciplina'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disciplina') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="objetivo_habilidade"> Objetivo e Habilidades	</label>
                <textarea class="form-control {{ $errors->has('objetivo_habilidade') ? 'is-invalid' : '' }}" name="objetivo_habilidade" id="objetivo_habilidade" required>{{ old('objetivo_habilidade') }}</textarea>
                @if($errors->has('objetivo_habilidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivo_habilidade') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="aprendizagem_desenvolvimento"> Objetivos de aprendizagem e desenvolvimento </label>
                <textarea class="form-control {{ $errors->has('aprendizagem_desenvolvimento') ? 'is-invalid' : '' }}" name="aprendizagem_desenvolvimento" id="aprendizagem_desenvolvimento" required>{{ old('aprendizagem_desenvolvimento') }}</textarea>
                @if($errors->has('aprendizagem_desenvolvimento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('aprendizagem_desenvolvimento') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label for="unidade_tematica"> Unidade temática	</label>
                <input class="form-control {{ $errors->has('unidade_tematica') ? 'is-invalid' : '' }}" type="text" name="unidade_tematica" id="unidade_tematica" value="{{ old('unidade_tematica', '') }}">
                @if($errors->has('unidade_tematica'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unidade_tematica') }}
                    </div>
                @endif
                <span class="help-block"> </span>
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
