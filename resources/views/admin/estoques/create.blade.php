@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cadastrar Estoque
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.estoques.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titulo">{{ trans('cruds.estoque.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', '') }}" required>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estoque.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descricao">{{ trans('cruds.estoque.fields.descricao') }}</label>
                <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="descricao" placeholder="Informe algo sobre esse registro caso acredite ser necessário…">{{ old('descricao') }}</textarea>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estoque.fields.descricao_helper') }}</span>
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
