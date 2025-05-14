@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Entrada
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entrada-no-estoques.update", [$entradaNoEstoque->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="produto_id">{{ trans('cruds.entradaNoEstoque.fields.produto') }}</label>
                <select class="form-control select2 {{ $errors->has('produto') ? 'is-invalid' : '' }}" name="produto_id" id="produto_id" required>
                  <option value=""> Selecione por favor </option>
                    @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}" {{ (old('produto_id') ? old('produto_id') : $entradaNoEstoque->produto->id ?? '') == $produto->id ? 'selected' : '' }}> Produto: {{ $produto->titulo }} | Unidade: {{ $produto->unidade }} |

                          @if(!in_array($produto->id, $produtos_array)) Não existe dentro do estoque @endif

                           @foreach($produtos_no_estoque as $produto_no_estoque)
                           @if($produto_no_estoque['produto_id'] == $produto->id )
                           @if($produto_no_estoque['estoque_id'] == $entradaNoEstoque->estoque_id )

                           Quantidade atual: {{ $produto_no_estoque['quantidade'] }}

                           @endif
                           @endif
                           @endforeach

                         </option>
                    @endforeach
                </select>
                @if($errors->has('produto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('produto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entradaNoEstoque.fields.produto_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="quatidade">{{ trans('cruds.entradaNoEstoque.fields.quatidade') }}</label>
                <input class="form-control" type="number" name="quatidade" id="quatidade" value="{{ old('quatidade', $entradaNoEstoque->quatidade) }}"
                min="0" onkeyup="if(this.value<0){this.value= this.value * -1}" required>
                <span class="help-block">{{ trans('cruds.entradaNoEstoque.fields.quatidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fornecedor_id">{{ trans('cruds.entradaNoEstoque.fields.fornecedor') }}</label>
                <select class="form-control select2 {{ $errors->has('fornecedor') ? 'is-invalid' : '' }}" name="fornecedor_id" id="fornecedor_id" required>
                    @foreach($fornecedors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('fornecedor_id') ? old('fornecedor_id') : $entradaNoEstoque->fornecedor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fornecedor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fornecedor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entradaNoEstoque.fields.fornecedor_helper') }}</span>
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
