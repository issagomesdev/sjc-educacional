@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Saída
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.saida-no-estoques.update", [$saidaNoEstoque->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="produto_id">{{ trans('cruds.saidaNoEstoque.fields.produto') }}</label>
                <select class="form-control select2 {{ $errors->has('produto') ? 'is-invalid' : '' }}" name="produto_id" id="produto_id" required>
                <option value=""> Selecione por favor </option>
                @foreach($produtos as $produto)
                <option value="{{ $produto->id }}" {{ (old('produto_id') ? old('produto_id') : $saidaNoEstoque->produto->id ?? '') == $produto->id ? 'selected' : '' }}>
                   Produto: {{ $produto->titulo }} | Unidade: {{ $produto->unidade }} |

                   @if(!in_array($produto->id, $produtos_array)) Não existe dentro do estoque @endif

                         @foreach($produtos_no_estoque as $produto_no_estoque)
                         @if($produto_no_estoque['produto_id'] == $produto->id )
                         @if($produto_no_estoque['estoque_id'] == $saidaNoEstoque->estoque_id )

                        Quantidade atual: {{ $produto_no_estoque['quantidade'] }}

                   @endif
                   @endif
                   @endforeach

                </option>
                @endforeach
                </select>

                <span class="help-block">{{ trans('cruds.saidaNoEstoque.fields.produto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quatidade">{{ trans('cruds.saidaNoEstoque.fields.quatidade') }}</label>
                <input class="form-control" type="text" name="quatidade" id="quatidade" value="{{ old('quatidade', $saidaNoEstoque->quatidade) }}"
                min="0" onkeyup="if(this.value<0){this.value= this.value * -1}" required>
                <span class="help-block">{{ trans('cruds.saidaNoEstoque.fields.quatidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="requisitante_id">{{ trans('cruds.saidaNoEstoque.fields.requisitante') }}</label>
                <select class="form-control select2 {{ $errors->has('requisitante') ? 'is-invalid' : '' }}" name="requisitante_id" id="requisitante_id" required>
                    @foreach($requisitantes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('requisitante_id') ? old('requisitante_id') : $saidaNoEstoque->requisitante->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('requisitante'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requisitante') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.saidaNoEstoque.fields.requisitante_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<style media="screen">

.alert-success {
    color: #fff;
    background-color: #fdd379;
    border-color: #fdd379;
}

</style>



@endsection
