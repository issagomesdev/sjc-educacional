@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Categoria
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.categorias-de-produtos.update", [$categoriasDeProduto->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="titulo">{{ trans('cruds.categoriasDeProduto.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', $categoriasDeProduto->titulo) }}" required>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.categoriasDeProduto.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.categoriasDeProduto.fields.descricao') }}</label>
                <input class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" id="descricao" placeholder="Informe algo sobre esse registro caso acredite ser necessário…" value="{{ old('descricao', $categoriasDeProduto->descricao) }}">
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.categoriasDeProduto.fields.descricao_helper') }}</span>
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
