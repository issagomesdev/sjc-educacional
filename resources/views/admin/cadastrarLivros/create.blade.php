@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cadastrar Livro
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cadastrar-livros.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titulo">{{ trans('cruds.cadastrarLivro.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', '') }}">
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="autor">{{ trans('cruds.cadastrarLivro.fields.autor') }}</label>
                <input class="form-control {{ $errors->has('autor') ? 'is-invalid' : '' }}" type="text" name="autor" id="autor" value="{{ old('autor', '') }}">
                @if($errors->has('autor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('autor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.autor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="idioma">{{ trans('cruds.cadastrarLivro.fields.idioma') }}</label>
                <input class="form-control {{ $errors->has('idioma') ? 'is-invalid' : '' }}" type="text" name="idioma" id="idioma" value="{{ old('idioma', '') }}">
                @if($errors->has('idioma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('idioma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.idioma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="biblioteca_id">{{ trans('cruds.cadastrarLivro.fields.biblioteca') }}</label>
                <select class="form-control select2 {{ $errors->has('biblioteca') ? 'is-invalid' : '' }}" name="biblioteca_id" id="biblioteca_id">
                    @foreach($bibliotecas as $id => $entry)
                        <option value="{{ $id }}" {{ old('biblioteca_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('biblioteca'))
                    <div class="invalid-feedback">
                        {{ $errors->first('biblioteca') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.biblioteca_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ano">{{ trans('cruds.cadastrarLivro.fields.ano') }}</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', '') }}" step="1">
                @if($errors->has('ano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.ano_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="editora">{{ trans('cruds.cadastrarLivro.fields.editora') }}</label>
                <input class="form-control {{ $errors->has('editora') ? 'is-invalid' : '' }}" type="text" name="editora" id="editora" value="{{ old('editora', '') }}">
                @if($errors->has('editora'))
                    <div class="invalid-feedback">
                        {{ $errors->first('editora') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.editora_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastrarLivro.fields.genero') }}</label>
                <select class="form-control {{ $errors->has('genero') ? 'is-invalid' : '' }}" name="genero" id="genero">
                    <option value disabled {{ old('genero', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CadastrarLivro::GENERO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('genero', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('genero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('genero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.genero_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assunto">{{ trans('cruds.cadastrarLivro.fields.assunto') }}</label>
                <input class="form-control {{ $errors->has('assunto') ? 'is-invalid' : '' }}" type="text" name="assunto" id="assunto" value="{{ old('assunto', '') }}">
                @if($errors->has('assunto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('assunto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.assunto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="materias_relacionadas">{{ trans('cruds.cadastrarLivro.fields.materias_relacionadas') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('materias_relacionadas') ? 'is-invalid' : '' }}" name="materias_relacionadas[]" id="materias_relacionadas" multiple>
                    @foreach($materias_relacionadas as $id => $materias_relacionada)
                        <option value="{{ $id }}" {{ in_array($id, old('materias_relacionadas', [])) ? 'selected' : '' }}>{{ $materias_relacionada }}</option>
                    @endforeach
                </select>
                @if($errors->has('materias_relacionadas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('materias_relacionadas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.materias_relacionadas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="exemplares_existentes">{{ trans('cruds.cadastrarLivro.fields.exemplares_existentes') }}</label>
                <input class="form-control {{ $errors->has('exemplares_existentes') ? 'is-invalid' : '' }}" type="number" name="exemplares_existentes" id="exemplares_existentes" value="{{ old('exemplares_existentes', '') }}" step="1">
                @if($errors->has('exemplares_existentes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('exemplares_existentes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.exemplares_existentes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="isbn">{{ trans('cruds.cadastrarLivro.fields.isbn') }}</label>
                <input class="form-control {{ $errors->has('isbn') ? 'is-invalid' : '' }}" type="text" name="isbn" id="isbn" value="{{ old('isbn', '') }}" step="1">
                @if($errors->has('isbn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('isbn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.isbn_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cdd">{{ trans('cruds.cadastrarLivro.fields.cdd') }}</label>
                <input class="form-control {{ $errors->has('cdd') ? 'is-invalid' : '' }}" type="text" name="cdd" id="cdd" value="{{ old('cdd', '') }}" step="1">
                @if($errors->has('cdd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cdd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.cdd_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastrarLivro.fields.selecione') }}</label>
                @foreach(App\Models\CadastrarLivro::SELECIONE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('selecione') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="selecione_{{ $key }}" name="selecione" value="{{ $key }}" {{ old('selecione', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="selecione_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('selecione'))
                    <div class="invalid-feedback">
                        {{ $errors->first('selecione') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarLivro.fields.selecione_helper') }}</span>
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
