@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.produto.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.produtos.update", [$produto->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="titulo">{{ trans('cruds.produto.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', $produto->titulo) }}" required>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.produto.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="unidade">{{ trans('cruds.produto.fields.unidade') }}</label>
                <input class="form-control {{ $errors->has('unidade') ? 'is-invalid' : '' }}" type="number" name="unidade" id="unidade" value="{{ old('unidade', $produto->unidade) }}">
                @if($errors->has('unidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.produto.fields.unidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categorias">{{ trans('cruds.produto.fields.categorias') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categorias') ? 'is-invalid' : '' }}" name="categorias[]" id="categorias" multiple>
                    @foreach($categorias as $id => $categoria)
                        <option value="{{ $id }}" {{ (in_array($id, old('categorias', [])) || $produto->categorias->contains($id)) ? 'selected' : '' }}>{{ $categoria }}</option>
                    @endforeach
                </select>
                @if($errors->has('categorias'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categorias') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.produto.fields.categorias_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.produto.fields.descricao') }}</label>
                <input class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" id="descricao" placeholder="Informe algo sobre esse registro caso acredite ser necessário…" value="{{ old('descricao', $produto->descricao) }}">
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.produto.fields.descricao_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.produto.fields.situacao') }}</label>
                <select class="form-control {{ $errors->has('situacao') ? 'is-invalid' : '' }}" name="situacao" id="situacao">
                    <option value disabled {{ old('situacao', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Produto::SITUACAO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('situacao', $produto->situacao) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('situacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.produto.fields.situacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.produto.fields.consumivel') }}</label>
                <select class="form-control {{ $errors->has('consumivel') ? 'is-invalid' : '' }}" name="consumivel" id="consumivel">
                    <option value disabled {{ old('consumivel', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Produto::CONSUMIVEL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('consumivel', $produto->consumivel) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('consumivel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('consumivel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.produto.fields.consumivel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="estoque_minimo">{{ trans('cruds.produto.fields.estoque_minimo') }}</label>
                <input class="form-control {{ $errors->has('estoque_minimo') ? 'is-invalid' : '' }}" type="number" name="estoque_minimo" id="estoque_minimo" value="{{ old('estoque_minimo', $produto->estoque_minimo) }}">
                @if($errors->has('estoque_minimo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estoque_minimo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.produto.fields.estoque_minimo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="estoque_maximo">{{ trans('cruds.produto.fields.estoque_maximo') }}</label>
                <input class="form-control {{ $errors->has('estoque_maximo') ? 'is-invalid' : '' }}" type="number" name="estoque_maximo" id="estoque_maximo" value="{{ old('estoque_maximo', $produto->estoque_maximo) }}">
                @if($errors->has('estoque_maximo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estoque_maximo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.produto.fields.estoque_maximo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="localizacao">{{ trans('cruds.produto.fields.localizacao') }}</label>
                <input class="form-control {{ $errors->has('localizacao') ? 'is-invalid' : '' }}" type="text" name="localizacao" id="localizacao" value="{{ old('localizacao', $produto->localizacao) }}">
                @if($errors->has('localizacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('localizacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.produto.fields.localizacao_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
